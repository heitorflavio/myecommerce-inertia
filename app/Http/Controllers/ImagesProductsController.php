<?php

namespace App\Http\Controllers;

use App\Models\ImagesProducts;
use App\Http\Requests\StoreImagesProductsRequest;
use App\Http\Requests\UpdateImagesProductsRequest;

class ImagesProductsController extends Controller
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
     * @param  \App\Http\Requests\StoreImagesProductsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImagesProductsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImagesProducts  $imagesProducts
     * @return \Illuminate\Http\Response
     */
    public function show(ImagesProducts $imagesProducts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImagesProducts  $imagesProducts
     * @return \Illuminate\Http\Response
     */
    public function edit(ImagesProducts $imagesProducts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImagesProductsRequest  $request
     * @param  \App\Models\ImagesProducts  $imagesProducts
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImagesProductsRequest $request, ImagesProducts $imagesProducts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImagesProducts  $imagesProducts
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImagesProducts $imagesProducts)
    {
        //
    }
}
