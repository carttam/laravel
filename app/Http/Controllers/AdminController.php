<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UserRequest;
use App\Models\PostModel;
use App\Models\RoleModel;
use App\Models\UserModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function test()
    {
    }

    public function index()
    {
        $login = LoginController::checkLogin();
        if ($login)
            if (LoginController::check_user_has_super_permission($login->role->level))
                return view('admin.index', ['users' => UserModel::all(), 'roles' => RoleModel::all()->sortByDesc('level')]);

        return response('<h1>You Do not Have Permission !</h1>', 403);
    }

    /*
     * handle post requests
     * Post Functions
    */

    public function insertUser(UserRequest $request)
    {
        $res = UserModel::insertUser($request);
        return redirect()->route('admin')->with($res['status'], $res['msg']);
    }

    public function insertRole(RoleRequest $request)
    {
        $msg = '';
        $status = '';
        try {
            $role = RoleModel::create($request->all());
            $msg = 'نقش ' . $role->type . ' با موفقیت اضافه شد .';
            $status = 'success';
        } catch (\Exception $ex) {
            $msg = 'خطایی رخ داده است با پشتیبانی تماس بگیرید .';
            $status = 'failed';
        } finally {
            return redirect()->route('admin')->with($status, $msg);
        }
    }


}
