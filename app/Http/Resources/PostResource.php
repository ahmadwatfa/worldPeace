<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'post' => $this->post,
            'is_pin' => $this->is_pin,
            'post_share_id' => new PostResource($this->share),
            'images' => $this->images,
            'videos' => $this->videos,
            'comments' => $this->comments,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
    // public function toArray($request)
    // {
    //     return [
    //         'id' => $this->id,
    //         'description' => $this->description,
    //         'is_pin' => $this->is_pin,
    //         'post_share' => new PostResource($this->share),
    //         'images'=>$this->media,
    //         'comment'=>$this->comment,
            
    //     ];
    // }
}
