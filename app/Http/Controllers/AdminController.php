<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Requests\UserRequest;
use App\Models\RoleModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index() : View
    {
        return view('admin.index',['users'=>UserModel::all(),'roles'=>RoleModel::all()->sortByDesc('level')]);
    }

    /*
     * handle post requests
     * Post Functions
    */

    public function insertUser(UserRequest $request)
    {
        $msg = '';
        $status = '';
        $usr = UserModel::create($request->all());
        if ($usr instanceof UserModel) {
            $msg = 'کاربر ' . $usr->full_name . ' با موفقیت اضافه شد .' ;
            $status = 'success';
        }
        else {
            $msg = 'خطایی رخ داده است با پشتیبانی تماس بگیرید .';
            $status = 'failed';
        }
        return redirect()->route('admin')->with($status,$msg);
    }

    public function insertRole(RoleRequest $request)
    {
        $msg = '';
        $status = '';
        $role = RoleModel::create($request->all());
        if ($role instanceof RoleModel) {
            $msg = 'نقش ' . $role->type . ' با موفقیت اضافه شد .' ;
            $status = 'success';
        }
        else {
            $msg = 'خطایی رخ داده است با پشتیبانی تماس بگیرید .';
            $status = 'failed';
        }
        return redirect()->route('admin')->with($status,$msg);
    }
}
