<?php

namespace App\Http\Requests;

use App\Http\Controllers\LoginController;
use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
        if ($this->input('password') !== null)
            return [
                'full_name' => 'required|min:3|max:80',
                'email' => 'required|email',
                'phone_number' => 'required|min:10|max:10|unique:user,phone_number,' . $this->input('id'),
                'role_id' => 'required',
                'password' => 'required|min:8|max:16',
            ];
        return [
            'full_name' => 'required|min:3|max:80',
            'email' => 'required|email',
            'phone_number' => 'required|min:10|max:10|unique:user,phone_number,' . $this->input('id'),
            'role_id' => 'required',
        ];
    }
}
