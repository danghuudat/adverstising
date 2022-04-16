<?php

namespace App\Http\Controllers;

use App\Models\AdvertisementPhoto;
use App\Http\Requests\StoreAdvertisementPhotoRequest;
use App\Http\Requests\UpdateAdvertisementPhotoRequest;

class AdvertisementPhotoController extends Controller
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
     * @param  \App\Http\Requests\StoreAdvertisementPhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvertisementPhotoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdvertisementPhoto  $advertisementPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(AdvertisementPhoto $advertisementPhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdvertisementPhoto  $advertisementPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(AdvertisementPhoto $advertisementPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdvertisementPhotoRequest  $request
     * @param  \App\Models\AdvertisementPhoto  $advertisementPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdvertisementPhotoRequest $request, AdvertisementPhoto $advertisementPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdvertisementPhoto  $advertisementPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdvertisementPhoto $advertisementPhoto)
    {
        //
    }
}
