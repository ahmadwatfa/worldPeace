<?php


namespace App\Repository;


use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use Illuminate\Http\Request;

class RestPasswordRepository extends BaseController
{
    private $model;
    public function __construct(User $user)
    {
        $this->model = $user;
    }
   public function  forget(Request $request)
   {
       $email = $request->input('email');
          if(User::where('email' , $email)->doesntExist())
          {
              return response()->json([
                  "success" => flase,
                  "message" => "User doesn't exists ",
                  "data" => $email
              ]);
          }
   }




}
