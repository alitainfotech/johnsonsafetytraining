<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Avilabledate;
use App\Models\Material;
use App\Models\Orderproduct;
use App\Traits\Dtable;
use App\Traits\Slugable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    use Slugable, Dtable;

    /**
     * @author Jayesh
     *
     * @uses Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * @author Jayesh
     *
     * @uses Fetch records from table
     *
     * @param  mixed $request
     * @return void
     */
    public function ajaxIndex(Request $request)
    {
        try {
            $results = $this->datatable($request, Product::class);
            $data = [];
            if (!empty($results['records'])) {
                foreach ($results['records'] as $record) {
                    $row['id'] = $record->id;
                    $row['name'] = $record->name;
                    // $row['slug'] = $record->slug;
                    $row['price'] = $record->price;
                    // $row['category'] = $record->category->name;
                    if ($record->status == '1') {
                        $row['status'] = '<span class="badge bg-success">' . config('constants.products.status_text.' . $record->status) . '</span>';
                    } else {
                        $row['status'] = '<span class="badge bg-danger">' . config('constants.products.status_text.' . $record->status) . '</span>';
                    }
                    $row['actions'] =
                        '<a class="btn btn-icon btn-xs btn-primary" title="Add Avilable Dates" href="' . route("admin.products.avilabledate", $record->id) . '">
                        <i data-feather="plus"></i>
                    </a>
                    <a class="btn btn-icon btn-xs btn" title="edit&show materials" href="' . route("admin.products.materialshow", $record->id) . '">
                        <i data-feather="file"></i>
                    </a>
                    <a class="btn btn-icon btn-xs btn-info" title="Show" href="' . route("admin.products.show", $record->id) . '">
                        <i data-feather="eye"></i>
                    </a>
                    <a class="btn btn-icon btn-xs btn-warning" title="Edit" href="' . route("admin.products.edit", $record->id) . '">
                        <i data-feather="edit"></i>
                    </a>
                    <button class="btn btn-icon btn-xs btn-danger deleteRecord" title="Delete" data-id="' . $record->id . '" data-route="' . route("admin.products.destroy", $record->id) . '">
                        <i data-feather="trash"></i>
                    </button>';
                    $data[] = $row;
                }
            }
            return response()->json([
                "draw" => $results['draw'],
                "recordsTotal" => $results['recordsTotal'],
                "recordsFiltered" => $results['recordsFiltered'],
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                "message" => 'Something went wrong. Please try again later.',
            ]);
        }
    }

    /**
     * @author Jayesh
     *
     * @uses Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * @author Jayesh
     *
     * @uses Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $product = Product::create($request->except('_token, files'));
            $product->slug = $this->createSlug(Product::class, $product->name, 0);
            $product->update();
            if ($request->has('files')) {
                foreach ($request->file('files') as $key => $file) {
                    $filenameWithExt = $file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $destinationPath = 'uploads/products/' . $product->id . '/';
                    $file->move($destinationPath, $fileNameToStore);
                    $product->images()->create([
                        'path' => $fileNameToStore,
                        'title' => $product->slug,
                        'type' => ($key == 0) ? '1' : '0'
                    ]);
                }
            }
            if ($request->has('materials')) {
                foreach ($request->file('materials') as $key => $material) {
                    $materialnameWithExt = $material->getClientOriginalName();
                    $materialname = pathinfo($materialnameWithExt, PATHINFO_FILENAME);
                    $extension = $material->getClientOriginalExtension();
                    $materialNameToStore = $materialname . '_' . time() . '.' . $extension;
                    $destinationPath = 'uploads/materials/' . $product->id . '/';
                    $material->move($destinationPath, $materialNameToStore);
                    $product->materials()->create([
                        'file_name' => $materialNameToStore,
                        'status' => ($key == 0) ? '1' : '0'
                    ]);
                }
            }
            return redirect(route('admin.products.index'))->with(['type' => 'success', 'message' => 'Product added successfully.']);
        } catch (\Exception $e) {
            return redirect(route('admin.products.index'))->with(['type' => 'danger', 'message' => 'Something went wrong. Please try again later.']);
        }
    }

    /**
     * @author Jayesh
     *
     * @uses Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load(['category', 'images']);
        return view('admin.products.show', compact('product'));
    }

    /**
     * @author Jayesh
     *
     * @uses Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product->load(['category', 'images']);
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.products.edit', compact(['categories', 'product']));
    }

    /**
     * @author Jayesh
     *
     * @uses Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product->update($request->except('_token, files'));
            $product->slug = $this->createSlug(Product::class, $product->name, $product->id);
            $product->update();
            if ($request->has('files')) {
                foreach ($request->file('files') as $key => $file) {
                    $filenameWithExt = $file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $destinationPath = 'uploads/products/' . $product->id . '/';
                    $file->move($destinationPath, $fileNameToStore);
                    $product->images()->create([
                        'path' => $fileNameToStore,
                        'title' => $product->slug,
                        'type' => ($key == 0) ? '1' : '0'
                    ]);
                }
            }
            return redirect(route('admin.products.index'))->with(['type' => 'success', 'message' => 'Product updated successfully.']);
        } catch (\Exception $e) {
            return redirect(route('admin.products.index'))->with(['type' => 'danger', 'message' => 'Something went wrong. Please try again later.']);
        }
    }

    /**
     * @author Jayesh
     *
     * @uses Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            $product->images()->delete();
            File::deleteDirectory('uploads/products/' . $product->id);
            return response()->json(['status' => true, 'message' => 'Category deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try again later.']);
        }
    }

    /**
     * @author Jayesh
     *
     * @uses Delete single image.
     *
     * @param  mixed $image
     * @return void
     */
    public function deleteImage(Image $image)
    {
        try {
            $image->delete();
            $directory = 'uploads/products/' . $image->product->id;
            if (File::exists($directory)) {
                $files = File::allFiles($directory);
                (count($files) == 1)
                    ? File::deleteDirectory($directory)
                    : File::delete($directory . '/' . $image->getAttributes()['path']);
            }
            return response()->json(['status' => true, 'message' => 'Category deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try again later.']);
        }
    }

    /**
     * @author Jayesh
     *
     * @uses Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function avilabledate(Product $product, $product_id)
    {
        $start = Carbon::today()->endOfDay()->toDateString();
        $endNext =  Carbon::parse($product->end_at)->endOfMonth()->toDateTimeString();
        $products = Avilabledate::where('product_id', $product_id)
            ->where('start_at', '>=', $start)
            // ->where('end_at', '=', null)
            ->where('end_at', '<=', $endNext)
            ->get();
        return view('admin.products.adddate', compact('products', 'product_id'));
    }

    public function avilabledatestore(Request $request)
    {
        try {
            $dateArr = $request->avilable_dates;
            foreach ($dateArr as $date) {
                if (is_null($request->end_at)) {
                    Avilabledate::create([
                        'product_id' => $request->product_id,
                        'start_at' => $date,
                        'end_at' => $date
                    ]);
                } else {
                    Avilabledate::create([
                        'product_id' => $request->product_id,
                        'start_at' => $date,
                        'end_at' => $request->end_at
                    ]);
                }
            }
            return redirect(route('admin.products.index'))->with(['type' => 'success', 'message' => 'Date added successfully.']);
        } catch (\Exception $e) {
            return redirect(route('admin.products.index'))->with(['type' => 'danger', 'message' => 'Something went wrong. Please try again later.']);
        }
        return view('admin.products.index');
    }

    /**
     * @author Jayesh
     *
     * @uses Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function addmaterial(Request $request, Product $product)
    {
        try {
            if ($request->has('materials')) {
                foreach ($request->file('materials') as $key => $material) {
                    $materialnameWithExt = $material->getClientOriginalName();
                    $materialname = pathinfo($materialnameWithExt, PATHINFO_FILENAME);
                    $extension = $material->getClientOriginalExtension();
                    $materialNameToStore = $materialname . '_' . time() . '.' . $extension;
                    $destinationPath = 'uploads/materials/' . $product->id . '/';
                    $material->move($destinationPath, $materialNameToStore);
                    $product->materials()->create([
                        'file_name' => $materialNameToStore,
                        'status' => ($key == 0) ? '1' : '0'
                    ]);
                }
            }
            return redirect(route('admin.products.index'))->with(['type' => 'success', 'message' => 'Date added successfully.']);
        } catch (\Exception $e) {
            redirect(route('admin.products.index'))->with(['type' => 'danger', 'message' => 'Something went wrong. Please try again later.']);
        }
    }

    public function materialshow(Product $product)
    {
        $product->load('materials');
        return view('admin.products.materialshow', compact('product'));
    }

    /**
     * @author Jayesh
     *
     * @uses Delete single material.
     *
     * @param  mixed $material
     * @return void
     */
    public function deletematerial(Material $material)
    {
        try {
            $material->delete();
            $directory = 'uploads/materials/' . $material->product->id;
            if (File::exists($directory)) {
                $files = File::allFiles($directory);
                (count($files) == 1)
                    ? File::deleteDirectory($directory)
                    : File::delete($directory . '/' . $material->getAttributes()['file_name']);
            }
            return response()->json(['status' => true, 'message' => 'Material deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try again later.']);
        }
    }

    public function studentcourse(request $request)
    {
        $orderproduct = Orderproduct::select('product_id', 'user_id')->get()->toArray();
        $user_id = Auth()->user()->id;
        $product_id = array_column($orderproduct, 'product_id');

        $studentcourse = Orderproduct::with([
            'product' => function ($query) {
                $query->select('id', 'name');
            },
            // 'user' => function ($query) {
            //     $query->select('id', 'full_name');
            // }
        ])
            ->where('user_id', $user_id)
            ->whereIn('product_id', $product_id)
            ->get()
            ->pluck('product.name', 'product.id');

        return view('admin.products.studentcourse', compact('studentcourse'));
    }

    public function studentmaterial($key)
    {
        $studentmaterial = Material::where('product_id', $key)->get();
        return view('admin.products.studentmaterial', compact('studentmaterial'));
    }
}
