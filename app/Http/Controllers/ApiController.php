<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    public function index()
    {
        return [
            'token' => UserModel::find(1)->createToken('create')->accessToken,
        ];
    }
}
