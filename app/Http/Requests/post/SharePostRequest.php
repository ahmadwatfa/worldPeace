<?php

namespace App\Http\Requests\post;

use Illuminate\Foundation\Http\FormRequest;

class SharePostRequest extends FormRequest
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
            'post' => 'nullable|max:255',
            'user_id' => 'exists:users,id',
            
            'post_id' => 'required|exists:posts,id',
        ];
    }
}
