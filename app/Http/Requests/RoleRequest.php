<?php

namespace App\Http\Requests;

use App\Http\Controllers\LoginController;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $login = LoginController::checkLogin();
        if ($login)
            return (bool)LoginController::check_user_has_super_permission($login->role->level);
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'=>'required|min:3|max:255',
            'level'=>'required|numeric|min:0|max:255',
        ];
    }
}
