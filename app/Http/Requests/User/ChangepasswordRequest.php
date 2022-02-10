<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class ChangepasswordRequest extends FormRequest
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
            
            'old_password' => 'required|nullable|min:8',
            'password' => 'required_with:old_password'
        ];
    }
}
