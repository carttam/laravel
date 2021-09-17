<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.index');
    }
    public function signup()
    {
        return view('login.signup');
    }

    public function logI(LoginRequest $request){
        return redirect()->route('home');
    }

    public function signU(HomeUserRequest $request)
    {
        try {
            $usr = UserModel::create([
                'full_name'=>$request->input('name'),
                'phone_number'=>$request->input('pn'),
                'password'=>$request->input('pw'),
                'email'=>$request->input('mail'),
                'role_id'=>'1',
            ]);
            do{
                $secret_key = Str::random('16');
            }while(UserModel::where('secret_key',$secret_key)->get()->count() > 0);
            $usr->secret_key = $secret_key;
            $usr->save();
            return redirect()->route('login');
        }catch (Exception $ex){
         return redirect()->route('signup');
        }
    }
}
