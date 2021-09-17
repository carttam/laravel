<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeUserRequest extends FormRequest
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
            'mail'=>'required|email',
            'pn'=>'required|min:10|max:10',
            'pw'=>'required|min:8|max:16',
            'name'=>'required|min:3|max:80',
        ];
    }
}
