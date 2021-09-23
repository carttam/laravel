<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
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

    public function removeUser($id)
    {
        $login = LoginController::checkLogin();
        if ($login instanceof UserModel && ctype_digit($id))
            if (LoginController::check_user_has_super_permission($login->role->level))
                if (UserModel::find($id)->delete())
                    return redirect()->route('admin')->with('success', 'کاربر با موفقیت حذف شد .');
        return response('Some Problem Happened ...', 405);
    }

    public function removeRole($id)
    {
        $login = LoginController::checkLogin();
        if ($login instanceof UserModel && ctype_digit($id))
            if (LoginController::check_user_has_super_permission($login->role->level))
                if (RoleModel::find($id)->delete())
                    return redirect()->route('admin')->with('success', 'نقش با موفقیت حذف شد .');
        return response('Some Problem Happened ...', 405);
    }

    /*
     * handle post requests
     * Post Functions
    */

    public function getUserList($id)
    {
        $login = LoginController::checkLogin();
        if ($login)
            if (LoginController::check_user_has_super_permission($login->role->level))
                return response(json_encode(UserModel::find($id)), 200, ['Content-Type' => 'application/json']);

        return response('<h1>You Do not Have Permission !</h1>', 403);
    }

    public function getRoleList($id)
    {
        $login = LoginController::checkLogin();
        if ($login)
            if (LoginController::check_user_has_super_permission($login->role->level))
                return response(json_encode(RoleModel::find($id)), 200, ['Content-Type' => 'application/json']);

        return response('<h1>You Do not Have Permission !</h1>', 403);
    }

    public function editUser(EditUserRequest $request)
    {
        $id = $request->input('id');
        if (ctype_digit($id)) {
            $request = $request->toArray();
            unset($request['id']);

            $user = UserModel::find($id);
            if ($user instanceof UserModel) {
                $user->update($request);
                return redirect()->route('admin')->with('success','کاربر با موفقیت بروزرسانی شد .');
            }
        }
        return redirect()->route('admin')->with('failed','خطایی رخ داده است با پشتیبانی تماس بگیرید .');
    }

    public function editRole(RoleRequest $request)
    {
        $id = $request->input('id');
        if (ctype_digit($id)) {
            $request = $request->toArray();
            unset($request['id']);

            $role = RoleModel::find($id);
            if ($role instanceof RoleModel) {
                $role->update($request);
                return redirect()->route('admin')->with('success','نقش با موفقیت بروزرسانی شد .');
            }
        }
        return redirect()->route('admin')->with('failed','خطایی رخ داده است با پشتیبانی تماس بگیرید .');
    }

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
