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
    public function index()
    {
        return view('admin.index', ['users' => UserModel::all(), 'roles' => RoleModel::all()->sortByDesc('level')]);
    }

    public function removeUser($id)
    {
        return redirect()->route('admin')->with('success', 'کاربر با موفقیت حذف شد .');
    }

    public function removeRole($id)
    {
                    return redirect()->route('admin')->with('success', 'نقش با موفقیت حذف شد .');
    }

    /*
     * handle post requests
     * Post Functions
    */

    public function getUserList($id)
    {
                return response(json_encode(UserModel::find($id)), 200, ['Content-Type' => 'application/json']);
    }

    public function getRoleList($id)
    {
                return response(json_encode(RoleModel::find($id)), 200, ['Content-Type' => 'application/json']);
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
                return redirect()->route('admin')->with('success', 'کاربر با موفقیت بروزرسانی شد .');
            }
        }
        return redirect()->route('admin')->with('failed', 'خطایی رخ داده است با پشتیبانی تماس بگیرید .');
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
                return redirect()->route('admin')->with('success', 'نقش با موفقیت بروزرسانی شد .');
            }
        }
        return redirect()->route('admin')->with('failed', 'خطایی رخ داده است با پشتیبانی تماس بگیرید .');
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
