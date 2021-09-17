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
        dd(UserModel::where('secret_key', '09P06UZGO3C6K7ZY')->get()->count() > 0);
    }

    public function index(): View
    {
        return view('admin.index', ['users' => UserModel::all(), 'roles' => RoleModel::all()->sortByDesc('level')]);
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
