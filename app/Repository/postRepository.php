<?php


namespace App\Repository;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\PostResource;
use App\Models\Api\Join;
use App\Models\Api\Like;
use App\Models\Api\Post;
use App\Models\Api\PostMedia;
use App\Repository\NotificationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class postRepository extends BaseController
{
    private $post;
    protected $notification;

    public function __construct(Post $model , \App\Repository\NotificationRepository $NotificationRepository)
    {
        $this->post = $model;
        $this->notification = $NotificationRepository;
    }
    public function index()
    {
        $user_id = Auth::user()->id ;
        $post = Post::where('user_id' ,  '='  , $user_id )->get();
      /*  return response()->json([
            "success" => true,
            "message" => "successfully",
            "data" => $post
        ]);*/
        return $this->sendResponse('successfully',PostResource::collection($post));

    }
    public function store(array $data)
    {
        $data['user_id'] = Auth::user()->id;
        $post = Post::create(['post'=>$data['post'] ,  'user_id'=>$data['user_id'] , 'is_pin'=>$data['is_pin']]);
            if(!empty($data['images'])){
            foreach ($data['images'] as $image){
                $filename = $image->store('public/images');
                PostMedia::create(['post_id' => $post->id ,'media'=> $filename, 'type'=>'image']);
            }
            }
        if(!empty($data['videos'])){
            foreach ($data['videos'] as $video){
                $filename = $video->store('public/videos');
                PostMedia::create(['post_id' => $post->id ,'media'=> $filename, 'type'=>'video']);
            }
        }
        if ($post->save()) {
            $friends = Join::where('user_id', Auth::user()->id)->pluck('friend_id')->toArray();

            foreach ($friends as $friend_id)
                $this->notification->sendNotification(Auth::user()->id, $friend_id, 'post', $post->id);
        }
        return $this->sendResponse('successfully', new PostResource($post));
    }
    public function destroy(array $data)
    {
        $user_id = Auth::user()->id ;
        $id = $data['id'];
        Post::where('user_id' ,  '='  , $user_id )->where('id' , '=' , $id)->delete();
     
        return $this->sendResponse('successfully', []);
    }

    public function like(array $data)
    {
        $user_id = Auth::user()->id;
        $post = Post::findOrFail($data['post_id']);
        $post_id = $data['post_id'];
        $like = Like::where('user_id' , $user_id)->where('post_id' ,  $post_id)->first();

        if($like)
        {

            $like->delete();

            return $this->sendResponse('successfully', new PostResource($post));

        }
        Like::create(['user_id'=> $user_id, 'post_id'=> $post_id]);
        return $this->sendResponse('successfully', new PostResource($post));

    }
    public function share(array $data)
    {
        $data['user_id'] = Auth::user()->id;
        $post = Post::findOrFail($data['post_id']);
        
        $post = Post::create(['post'=>$data['post'] ?? "" , 'is_pin'=>$data['is_pin'] , 'user_id'=>$data['user_id'] ,'post_share_id'=>$post->id]);
        if(!empty($data['images'])){
            foreach ($data['images'] as $image){
                $filename = $image->store('public/images');
                PostMedia::create(['post_id' => $post->id ,'media'=> $filename, 'type'=>'image']);
            }
        }
        if(!empty($data['videos'])){
            foreach ($data['videos'] as $video){
                $filename = $video->store('public/videos');
                PostMedia::create(['post_id' => $post->id ,'media'=> $filename, 'type'=>'video']);
            }
        }
        return $this->sendResponse('successfully', new PostResource($post));
    }

    public function timeLine(array $data)

    {
         $data['user_id'] = Auth::user()->id;
         $post = Post::where('user_id' , $data['user_id'])->pluck('id')->toArray();
         $friend_id = Join::where('user_id' , $data['user_id'])->pluck('friend_id')->toArray();
         $post_friend = Post::whereIn('user_id' , $friend_id)->pluck('id')->toArray();
         $posts_id = array_merge($post , $post_friend);
         $posts = Post::whereIn('id' , $posts_id)->count();
         $page_size = $data['page_size'] ?? 10 ;
         $current_page = $data['current_page'] ?? 1;
         $total_page = ceil($posts / $page_size);
         $skip = $page_size * ($current_page - 1);
         $all_posts = Post::whereIn('id' , $posts_id)->skip($skip)->take($page_size)->orderByDesc('created_at')->get();;
        //  return $this->sendResponse('successfully',PostResource::collection($all_posts));
         return $this->sendResponse('all posts',['total_page'=>$total_page,
         'current_page'=>$current_page,'data'=>PostResource::collection($all_posts)]);
    }      
       
       
    
    }


