<?php

namespace App\Http\Controllers;

use App\Models\CartProducts;
use App\Http\Requests\StoreCartProductsRequest;
use App\Http\Requests\UpdateCartProductsRequest;
use Illuminate\Http\Request;

class CartProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreCartProductsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartProductsRequest $request)
    {
        //
        $check = CartProducts::where('cart_id', $request->cart_id)->where('product_id', $request->product_id)->where('status', 1)->first();
        if ($check != null) {
            $check->quantity = $check->quantity + $request->quantity;
            $check->save();
            return response()->json($check, 201);
        } else {
            $product = CartProducts::create($request->all());
            return response()->json($product, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CartProducts  $cartProducts
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $cartProducts = CartProducts::where('cart_id', $request->cart_id)->where('status', 1)->get();
        return response()->json($cartProducts, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CartProducts  $cartProducts
     * @return \Illuminate\Http\Response
     */
    public function edit(CartProducts $cartProducts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartProductsRequest  $request
     * @param  \App\Models\CartProducts  $cartProducts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $check = CartProducts::where('product_id', $request->product_id)->where('cart_id', $request->cart_id)->where('status', 1)->first();
        $newQuantity = $check->quantity + 1;
        $check->update(['quantity' => $newQuantity]);
        return response()->json($check, 201);
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartProductsRequest  $request
     * @param  \App\Models\CartProducts  $cartProducts
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        $check = CartProducts::where('product_id', $request->product_id)->where('cart_id', $request->cart_id)->where('status', 1)->first();
        $newQuantity = $check->quantity - 1;
        $check->update(['quantity' => $newQuantity]);
        return response()->json($check, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartProducts  $cartProducts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $check = CartProducts::where('product_id', $request->product_id)->where('cart_id', $request->cart_id)->where('status', 1)->first();
        $check->update(['status' => 0]);
        return response()->json($check, 201);
    }
}
