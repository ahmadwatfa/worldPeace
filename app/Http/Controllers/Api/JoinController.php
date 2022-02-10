<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Join;
use App\Repository\JoinRepository;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    private $joinRepository;
    public function __construct(JoinRepository $joinRepository)
    {
        $this->joinRepository = $joinRepository;
    }
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return  $this->joinRepository->join($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Api\Join  $join
     * @return \Illuminate\Http\Response
     */
    public function show(Join $join)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Api\Join  $join
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Join $join)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Api\Join  $join
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return  $this->joinRepository->unjoin($request->all());

    }
}
