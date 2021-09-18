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

    public static function checkLogin()
    {
        $email= session('email');
        $password= session('password');
        if ($email && $password) {
            $usr = UserModel::where('email','=',$email)->where('password','=',$password)->first();
            if ($usr instanceof UserModel)
                return $usr;
        }
        return false;
    }

    public static function check_user_has_super_permission($lvl = 0): bool
    {
        if ($lvl > 199)
            return true;
        else
            return false;
    }

    public function logI(LoginRequest $request)
    {
        session(['email' => $request->input('mail'),
            'password' => $request->input('pw')
        ]);
        return redirect()->route('home');
    }

    public function signU(HomeUserRequest $request)
    {
        try {
            $usr = UserModel::create([
                'full_name' => $request->input('name'),
                'phone_number' => $request->input('pn'),
                'password' => $request->input('pw'),
                'email' => $request->input('mail'),
                'role_id' => '1',
            ]);
            do {
                $secret_key = Str::random('16');
            } while (UserModel::where('secret_key', $secret_key)->get()->count() > 0);
            $usr->secret_key = $secret_key;
            $usr->save();
            return redirect()->route('login');
        } catch (Exception $ex) {
            return redirect()->route('signup');
        }
    }
}
