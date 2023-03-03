<?php

namespace App\Http\Controllers;

use App\Models\pengalaman;
use App\Http\Requests\StorepengalamanRequest;
use App\Http\Requests\UpdatepengalamanRequest;

class PengalamanController extends Controller
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
     * @param  \App\Http\Requests\StorepengalamanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepengalamanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pengalaman  $pengalaman
     * @return \Illuminate\Http\Response
     */
    public function show(pengalaman $pengalaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pengalaman  $pengalaman
     * @return \Illuminate\Http\Response
     */
    public function edit(pengalaman $pengalaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepengalamanRequest  $request
     * @param  \App\Models\pengalaman  $pengalaman
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepengalamanRequest $request, pengalaman $pengalaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pengalaman  $pengalaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(pengalaman $pengalaman)
    {
        //
    }
}
