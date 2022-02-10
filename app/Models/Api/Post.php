<?php

namespace App\Models\Api;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function images()
    {
        return $this->hasMany(PostMedia::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function share(){
        return $this->belongsTo(Post::class,'post_share_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getPhotoAttribute($value)
    {
        return url('storage/'.$value);
    }
}
