<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UserRequest;
use App\Models\PostModel;
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
        try {
            $usr = RoleModel::create($request->all());
            $msg = 'پست ' . $usr->full_name . ' با موفقیت اضافه شد .' ;
            $status = 'success';
        }catch (\Exception $ex){
            $msg = 'خطایی رخ داده است با پشتیبانی تماس بگیرید .';
            $status = 'failed';
        } finally {
            return redirect()->route('admin')->with($status,$msg);
        }
    }

    public function insertRole(RoleRequest $request)
    {
        $msg = '';
        $status = '';
        try {
            $role = RoleModel::create($request->all());
            $msg = 'پست ' . $role->type . ' با موفقیت اضافه شد .' ;
            $status = 'success';
        }catch (\Exception $ex){
            $msg = 'خطایی رخ داده است با پشتیبانی تماس بگیرید .';
            $status = 'failed';
        } finally {
            return redirect()->route('admin')->with($status,$msg);
        }
    }

    public function insertPost(PostRequest $request)
    {
        $msg = '';
        $status = '';
        try {
            $post = PostModel::create($request->all());
            $msg = 'پست ' . $post->title . ' با موفقیت اضافه شد .' ;
            $status = 'success';
        }catch (Exception $ex){
            $msg = 'خطایی رخ داده است با پشتیبانی تماس بگیرید .';
            $status = 'failed';
        } finally {
            return redirect()->route('admin')->with($status,$msg);
        }
    }
}
