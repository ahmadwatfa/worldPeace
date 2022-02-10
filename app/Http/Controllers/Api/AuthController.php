<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private $user;
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
  /* public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }
*/
    public function register(RegisterRequest $request){
        return $this->user->register($request->all());
    }
    public function login()
    {
       return $this->user->login();
    }
    public function getUser()
    {
        return $this->user->getUser();
    }
}
