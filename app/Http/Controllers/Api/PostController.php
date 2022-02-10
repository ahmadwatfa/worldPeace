<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\post\DeletePostRequest;
use App\Http\Requests\post\LikePostRequest;
use App\Http\Requests\post\PostRequest ;
use App\Http\Requests\post\SharePostRequest;
use App\Repository\postRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postRepository;
    public function __construct(postRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $this->postRepository->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        return  $this->postRepository->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function like(LikePostRequest $request)
    {
        return  $this->postRepository->like($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function share(SharePostRequest $request)
    {
        return  $this->postRepository->share($request->all());

    }

    public function timeLine(Request $request)
    {
        return  $this->postRepository->timeLine($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeletePostRequest $request)
    {
        return  $this->postRepository->destroy($request->all());
    }

}
