<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('welcome',[
            'listOfProduct' => $products->take(5)
        ]);
    }

    /**
     * Process for purchase a subscription.
     *
     * @return \Illuminate\Http\Response
     */
    public function purchase(Request $request)
    {
        //
        $productId = $request->productId;
        $userId = Auth::user()->id;

        // Create Invoices
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $product)
    {
        //
        $getProduct = Product::find($product);
        return view('product.detail', [
            'product' => $getProduct,
        ]);
    }

    /**
     * Display all Products For Authorized User
     */
    public function showAll() 
    {
        $products = Product::all();
        return view('dashboard',[
            'listOfProduct' => $products
        ]);
    }

    
}
