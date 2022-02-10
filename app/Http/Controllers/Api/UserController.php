<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\ChangepasswordRequest;
use App\Http\Requests\user\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $UserRepository;
    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function index()
    {
        return $user = $this->UserRepository->index();

    }
*/
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        return  $this->UserRepository->updateUser($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changePassword(ChangepasswordRequest $request)
    {
        return  $this->UserRepository->changePassword($request->all());

    }

//    public function logout(Request $request)
//    {
//        return  $this->UserRepository->logout($request->all());
//    }
// log the author out
    public function logout(Request $request){
        $user = Auth::user()->token();
        return $user;

        $user->revoke();
        return $this->sendResponse('successfully' , []);
    }
}
