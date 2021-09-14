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
        return response((Storage::exists('upload/1/IPvWRQOtaHpJ1RTp.jpg')));
    }

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
        $msg = 'خطایی رخ داده است با پشتیبانی تماس بگیرید.';
        $status = 'failed';
        $user = UserModel::all()->where('email','=','Willett6@nowhere.com')->where('password','=','4pbz65w/udEgEhwwXU/O/Q==')->first(); // TODO : must set dynamic username
        if ($user instanceof UserModel){

            try {
                $file_path = 'upload/'.$user->secret_key.'/';
                do{
                    $file_name = Str::random(32).'.'.$request->file('file')->getClientOriginalExtension();
                }while(Storage::exists($file_path.$file_name));

                $post = PostModel::create([
                    'description'=>$request->input('description'),
                    'file_type'=>$request->file('file')->getMimeType(),
                    'file_name'=>$file_name,
                    'user_id'=>$user->id,
                ]);

                $request->file('file')->storeAs($file_path,$file_name);
                $msg = 'پست با موفقیت اضافه شد.';
                $status = 'success';
            }catch (QueryException $ex){
                // Do Nothing ...
            } finally {
                return redirect()->route('admin')->with($status,$msg);
            }

        }
    }
}
