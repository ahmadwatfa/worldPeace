<?php

namespace App\Http\Controllers;

use App\Models\Api\PostMedia;
use App\Http\Requests\StorePostMediaRequest;
use App\Http\Requests\UpdatePostMediaRequest;

class PostMediaController extends Controller
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
     * @param  \App\Http\Requests\StorePostMediaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostMediaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Api\PostMedia  $postMedia
     * @return \Illuminate\Http\Response
     */
    public function show(PostMedia $postMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Api\PostMedia  $postMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(PostMedia $postMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostMediaRequest  $request
     * @param  \App\Models\Api\PostMedia  $postMedia
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostMediaRequest $request, PostMedia $postMedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Api\PostMedia  $postMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostMedia $postMedia)
    {
        //
    }
}
