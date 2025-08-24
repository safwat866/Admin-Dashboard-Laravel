<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Cookie::get('user_id');
        $user = User::where("id", $userId)->first();

        $products = Products::all();
        return view("pages.products", [
            'user' => $user,
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Products::create([
            'product_name' => $request->name,
            'product_description' => $request->description,
            'product_image' => $request->product_image,
            'product_price' => $request->price,
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        $userId = Cookie::get('user_id');
        $user = User::where("id", $userId)->first();
        return view("pages.product_edit", [
            'user' => $user,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        $product->update([
            'product_name' => $request->name,
            'product_description' => $request->description,
            'product_price' => preg_replace('/[^0-9.]/', '', $request->price),
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
