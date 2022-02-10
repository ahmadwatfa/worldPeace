<?php

namespace App\Http\Requests\post;

use Illuminate\Foundation\Http\FormRequest;

class LikePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'post_id' => 'required|exists:posts,id',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'This post is required',
            'post_id.exists' => 'This post does not exist'
           
        ];
    }
}
