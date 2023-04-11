<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Product;

class cartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.carts.index');
    }

    /**
     * Show the form for creating a new cart.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product,$availableId)
    {
        $availableId = $availableId;
        $id = $product->id;
        $product = Product::with('images')->findOrFail($id)->toArray();
        $cart = session()->get('cart', []);
        
        // if (isset($cart[$id])) {
        //     $cart[$id];
        // } else {
            $cart[$id] = [  
                "id" => $id,
                "name" => $product['name'],
                // "quantity" => 1,
                "price" => $product['price'],
                "image" => $product['images'][0]['path'],
                'availableId' => encrypt($availableId),
            ];
        // }
        session()->put('cart', $cart);
        return redirect('index');
        // return redirect()->back()->with('success', 'Product added to cart successfully!');
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
    public function show($id)
    {
        //
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
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}