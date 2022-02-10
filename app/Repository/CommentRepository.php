<?php


namespace App\Repository;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CommentResource;
use App\Models\Api\Comment;
use App\Models\Api\Post;
use Illuminate\Support\Facades\Auth;

class CommentRepository extends BaseController
{
    private $comment;
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function index($id)
    {
       $comments = Comment::where('post_id' , '=' , $id)->with('post')->get();

        return response()->json([
            "success" => true,
            "message" => "successfully",
            "data" => $comments
        ]);
    }

    public function store(array $data)
    {

        $data['user_id'] = Auth::user()->id;
        $comment = Comment::create(['comment' => $data['comment'] , 'user_id' => $data['user_id'] , 'post_id' =>  $data['id']]);
        return $this->sendResponse('successfully',new CommentResource($comment));
    }
    public function destroy($id)
    {
        $user_id = Auth::user()->id ;
        Comment::where('user_id' ,  '='  , $user_id )->where('id' , '=' , $id)->delete();
        $post = Post::where('id' , '=' , $id)->with('comments')->get();
        return response()->json([
            "success" => true,
            "message" => "successfully",
            "data" => $post ,
        ]);
    }
}
