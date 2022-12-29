<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Payment;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $selectedProduct = Product::find($request->productId);
        $user = Auth::user();

        $invoiceNumber = date('YmdHis');

        // Create Invoices
        $newInvoice = Payment::create([
            'InvoiceNumber' => 'INV-' . $invoiceNumber,
            'InvoiceSum' => $selectedProduct->Price,
            'status' => 'unpaid'
        ]);

        $newInvoice->user()->associate($user);
        $newInvoice->save();

        //
        $selectedProduct->subscriptions()->attach($newInvoice);

        return view('product.detail', [
            'product' => $selectedProduct,
            'message' => 'Succesfully Purchased'
        ]);
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
        $subscribed = Auth::user()->subscribes()->get();
        $channelSubcribed = collect([]);

        $loadProducts = $subscribed->load('product')->all();

        foreach($loadProducts as $item)
        {
            $ids = $item->product()->get();
            $channelSubcribed->push($ids->pluck('id'));
        }

        return view('dashboard',[
            'listOfProduct' => $products,
            'subcribedProducts' => $channelSubcribed->flatten(1)->values()->toArray(),
        ]);
    }

    
}
