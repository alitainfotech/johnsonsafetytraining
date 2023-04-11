<?php

namespace App\Http\Controllers;

use App\Models\Avilabledate;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use DateTime;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCourseByCategory(Category $category)
    {
        $products = $category->products()->with(['images', 'category'])->get();
        return view('user.products.showcourse', compact('products', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $products = $product->with(['category', 'images'])
            ->with('avilabledates', function ($query) {
                $query->where('start_at', '>', Carbon::today()->endOfDay()->toDateString());
            })
            ->where('id', $product->id)
            ->first();

        $avilabledates = $product->avilabledates()->where('product_id', $product->id)->get();
        $total_day = 1;
        foreach ($avilabledates as $avilabledate) {
            $startdate = new DateTime($avilabledate->start_at);
            $enddate = new DateTime($avilabledate->end_at);
            $days = $startdate->diff($enddate);
            $total_day = $days->days;
        }
        if ($total_day == 0) {
            $total_day = 1;
        }
        return view('user.products.singlecourse', compact('products', 'total_day'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
