<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Traits\Dtable;
use App\Traits\Slugable;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        return view('admin.categories.index');
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
            $results = $this->datatable($request, Category::class);
            $data = [];
            if(!empty($results['records'])) {
                foreach($results['records'] as $record) {
                    $row['id'] = $record->id;
                    $row['name'] = $record->name;
                    $row['slug'] = $record->slug;
                    $row['actions'] = '<a class="btn btn-icon btn-xs btn-warning" href="' . route("admin.categories.edit", $record->id) . '"><i data-feather="edit"></i></a> <button class="btn btn-icon btn-xs btn-danger deleteRecord" data-id="' . $record->id . '" data-route="' . route("admin.categories.destroy", $record->id) . '"><i data-feather="trash"></i></button>';
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
        return view('admin.categories.create');
    }

    /**
     * @author Jayesh
     * 
     * @uses Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $category = Category::create($request->except('_token'));
            $category->slug = $this->createSlug(Category::class, $category->name, 0);
            $category->update();
            return redirect(route('admin.categories.index'))->with(['type' => 'success', 'message' => 'Category added successfully.']);
        } catch (\Exception $e) {
            return redirect(route('admin.categories.index'))->with(['type' => 'danger', 'message' => 'Something went wrong. Please try again later.']);
        }
    }

    /**
     * @author Jayesh
     * 
     * @uses Display the specified resource.
     * 
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * @author Jayesh
     * 
     * @uses Show the form for editing the specified resource.
     * 
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * @author Jayesh
     * 
     * @uses Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category->slug = $this->createSlug(Category::class, $request->name, $category->id);
            $category->update($request->except(['_token', '_method']));
            return redirect(route('admin.categories.index'))->with(['type' => 'success', 'message' => 'Category updated successfully.']);
        } catch (\Exception $e) {
            return redirect(route('admin.categories.index'))->with(['type' => 'danger', 'message' => 'Something went wrong. Please try again later.']);
        }
    }

    /**
     * @author Jayesh
     * 
     * @uses Remove the specified resource from storage.
     * 
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json(['status' => true, 'message' => 'Category deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong. Please try again later.']);
        }
    }
}
