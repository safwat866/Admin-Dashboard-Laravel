<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();
        return view("pages.products", compact("products"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can("add product")) {
            return back()->withErrors([
                "permession" => "You don't have permession to do this action"
            ]);
        }

        Products::create([
            'product_name' => $request->name,
            'product_description' => $request->description,
            'product_image' => $request->product_image,
            'product_price' => $request->price,
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        if (!Auth::user()->can("edit product")) {
            return back()->withErrors([
                "permession" => "You don't have permession to do this action"
            ]);
        }

        return view("pages.product_edit", compact("product"));
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
        if (!Auth::user()->can("edit product")) {
            return back()->withErrors([
                "permession" => "You don't have permession to do this action"
            ]);
        }

        $product->delete();
        return redirect()->route('products.index');
    }

    public function bulkDelete(Request $request)
    {
        if (!Auth::user()->can("edit product")) {
            return back()->withErrors([
                "permession" => "You don't have permession to do this action"
            ]);
        }
        Products::destroy($request->products);
        return redirect()->route("products.index");
    }
}
