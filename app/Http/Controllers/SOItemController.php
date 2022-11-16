<?php

namespace App\Http\Controllers;

use App\Models\SOItem;
use App\Http\Requests\StoreSOItemRequest;
use App\Http\Requests\UpdateSOItemRequest;

class SOItemController extends Controller
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
     * @param  \App\Http\Requests\StoreSOItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSOItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SOItem  $sOItem
     * @return \Illuminate\Http\Response
     */
    public function show(SOItem $sOItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SOItem  $sOItem
     * @return \Illuminate\Http\Response
     */
    public function edit(SOItem $sOItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSOItemRequest  $request
     * @param  \App\Models\SOItem  $sOItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSOItemRequest $request, SOItem $sOItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SOItem  $sOItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(SOItem $sOItem)
    {
        //
    }
}
