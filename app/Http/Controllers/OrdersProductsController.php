<?php

namespace App\Http\Controllers;

use App\Models\OrdersProducts;
use App\Http\Requests\StoreOrdersProductsRequest;
use App\Http\Requests\UpdateOrdersProductsRequest;

class OrdersProductsController extends Controller
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
     * @param  \App\Http\Requests\StoreOrdersProductsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrdersProductsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrdersProducts  $ordersProducts
     * @return \Illuminate\Http\Response
     */
    public function show(OrdersProducts $ordersProducts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrdersProducts  $ordersProducts
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdersProducts $ordersProducts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrdersProductsRequest  $request
     * @param  \App\Models\OrdersProducts  $ordersProducts
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrdersProductsRequest $request, OrdersProducts $ordersProducts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrdersProducts  $ordersProducts
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdersProducts $ordersProducts)
    {
        //
    }
}
