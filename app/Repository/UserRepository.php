<?php


namespace App\Repository;


use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\user\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Api\FcmToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Token;
use Laravel\Passport\RefreshToken;

class UserRepository extends BaseController
{
    private $model;
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /*public  function index()
    {
        return $user = User::get();

    }*/
    public function register(array $data)
    {

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return $this->sendResponse('User register successfully.' ,$success);
    }
    public  function login()
    {
        $proxy = Request::create('oauth/token', 'POST');
        $response = Route::dispatch($proxy);

        $statusCode = $response->getStatusCode();
        $response = json_decode($response->getContent());

        if ($statusCode != 200)
            return $this->sendError($response->message);
        $response_token = $response;
        $token = $response->access_token;
        \request()->headers->set('Authorization', 'Bearer ' . $token);
        $proxy = Request::create('api/getUser', 'GET');
        $response = Route::dispatch($proxy);
        //dd($response);
        $statusCode = $response->getStatusCode();
        //dd(json_decode($response->getContent()));
        $user = json_decode($response->getContent())->item;
        //($user);

        if (isset($user)) {
            // create fcm token

            $data = \request()->all();
            $data['user_id'] = $user->id;
            if (isset($data['fcm_token'])) {

                $fcmToken = FcmToken::where('device_type', $data['device_type'])->where('user_id', $user->id)->where('device_id', $data['device_id'])->first();
                if (!isset($fcmToken))
                    FcmToken::create($data);
                else{
                    $fcmToken->fcm_token = $data['fcm_token'] ;
                    $fcmToken->save();
                }
            }
        }

        return $this->sendResponse('Successfully Login', ['token' => $response_token, 'user' => $user]);

    }
    public function getUser(){
        $user=auth()->user();
        return $this->sendResponse('user info', $user);
    }

    public function updateUser(array $data)
    {
           $id = Auth::user()->id;

          $user = User::findOrFail($id);

        if (!empty($data['photo']))
        {
           $image = $data['photo']->store('public/images/users');
            $user->photo = $image;
            $user->update($data);
            return $this->sendResponse('successfully',new UserResource($user));
        }

        $user->update($data);

        return $this->sendResponse('successfully', new UserResource ($user));

    }
    public function changePassword(array $data)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        if (Hash::check($data['old_password'], $user->password)) {
            $user->update([
                'password' => Hash::make($data['password'])
            ]);
            return $this->sendResponse('successfully',new UserResource($user));
        } else {
            return $this->sendError(422 ,'old passwoed dosn\'t match');;
        }
    }
    // public function logout(array $data)
    // {

    //     $user = Auth::user()->token();
    //     $user->revoke;

    //     return $this->sendResponse('successfully' , []);

    // }
    public function logout(array $data){
        $user = Auth::user()->token();
        $user->revoke();
        return $this->sendResponse('successfully' , []);
    }
}
