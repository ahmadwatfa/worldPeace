<?php


namespace App\Repository;


use App\Models\Api\Join;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class JoinRepository
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function join(array $data)
    {
        $user_id = Auth::user()->id;
        $friend_id = $data['friend_id'];
        if($user_id == $friend_id)
        {
            return response()->json([
            "success" => true,
            "message" => "you can't add yourself",
//            "data" => $friend ,
        ]);
        }
        $friend = User::where('id',$friend_id)->first();
        $join = Join::where('user_id' , $user_id)->where('friend_id' ,  $friend_id)->first();

        if($join)
        {

            $join->delete();

            return response()->json([
                "success" => true,
                "message" => "successfully",
                "data" => $friend ,
            ]);

        }
        Join::create(['user_id'=> $user_id, 'friend_id'=> $friend_id]);
        return response()->json([
            "success" => true,
            "message" => "successfully",
            "data" => $friend ,
        ]);

    }
    public function unjoin(array $data)
    {
        $user_id = Auth::user()->id;
        $friend_id = $data['friend_id'];
       $friend = User::where('id', $friend_id)->first();
        $friends = Join::where('user_id', $user_id)->get();
        $join = Join::where('user_id', $user_id)->where('friend_id', $friend_id)->first();

        if ($join) {

            $join->delete();

            return response()->json([
                "success" => true,
                "message" => "successfully",
                "data" => $friend,
            ]);

        }
        return response()->json([
            "success" => true,
            "message" => "He is not your friend",
            "data" => $friends,
        ]);
    }
}
