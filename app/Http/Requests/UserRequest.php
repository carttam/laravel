<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'full_name' => 'required|min:3|max:80',
            'email' => 'required|email',
            'phone_number' => 'required|min:10|max:10',
            'role_id' => 'required',
            'password' => 'required|min:8|max:16',
        ];
    }
}
