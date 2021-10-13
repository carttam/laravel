<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\HomeUserRequest;
use App\Http\Requests\PostRequest;
use App\Models\CommentModel;
use App\Models\PostModel;
use App\Models\UserModel;
use Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Exception;

class ApiController extends Controller
{
    public function index()
    {
        return response(json_encode(PostModel::join('user', 'user_id', '=', 'user.id')->select(['post.*', 'user.full_name'])->paginate(10), JSON_UNESCAPED_UNICODE), 200, ['Content-Type' => 'application/json']);
    }

    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->json('email'),
            'password' => md5($request->json('password'))
        ], false))
         return json_encode([
                'status' => 'success',
                'message' => trans('api.user.login.success'),
                'token' => Auth::user()->createToken('Token Name')->accessToken
            ], JSON_UNESCAPED_UNICODE);
        return json_encode([
            'status' => 'failed',
            'message' => trans('api.user.login.failed'),
        ], JSON_UNESCAPED_UNICODE);
    }

    public function logout()
    {
        Auth::user()->token()->revoke();
        return response()->json(["status"=>"success"],200);
    }

    public function signUp(HomeUserRequest $request)
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
            return response(
                json_encode([
                    'status' => 'success',
                    'message' => trans('api.user.signUp.success'),
                    'token' => $usr->createToken('create')->accessToken,
                ], JSON_UNESCAPED_UNICODE)
                , 200);
        } catch (Exception $ex) {
            return response(
                json_encode([
                    'status' => 'failed',
                    'message' => trans('api.user.signUp.failed'),
                ], JSON_UNESCAPED_UNICODE)
                , 400);
        }
    }

    public function addComment(CommentRequest $request)
    {
        try {
            $cm = (new CommentModel())->setTable('comment_' . $request->json('post_id'));

            $usr = Auth::user();
            $cm->user_id = $usr->id;
            $cm->comment = $request->json('comment');
            $cm->save();
            return response(
                json_encode([
                    'status' => 'success',
                    'message' => trans('api.user.comment.success'),
                ], JSON_UNESCAPED_UNICODE)
                , 200);

        } catch (QueryException $ex) {
            return response(
                json_encode([
                    'status' => 'failed',
                    'message' => trans('api.user.comment.failed'),
                ], JSON_UNESCAPED_UNICODE)
                , 400);
        }
    }

    public function addPost(Request $request)
    {
        $user = Auth::user();
        try {
            $file_path = 'upload/' . $user->secret_key . '/';
            $base64_image = base64_decode($request->json('file'));
            $file_mimeType = explode('/',finfo_buffer(finfo_open(),$base64_image,FILEINFO_MIME_TYPE))[1];
            do {
                $file_name = Str::random(32) . '.' . $file_mimeType;
            } while (Storage::exists($file_path . $file_name));


            // add post to mysql
            $post = PostModel::create([
                'description' => $request->json('description'),
                'file_type' => $file_mimeType,
                'file_name' => $file_name,
                'user_id' => $user->id,
            ]);

            // Convert base64 image to image
            $f = fopen(storage_path('app/'.$file_path.$file_name),'w+');
            fwrite($f,$base64_image);
            fclose($f);

            $post->create_comment_table();
            $msg = 'پست با موفقیت اضافه شد .';
        } catch (QueryException | \Exception $ex) {
            $msg = 'خطایی رخ داده است.';
        } finally {
            return response()->json(['message'=>$msg], JSON_UNESCAPED_UNICODE);
        }
    }

    public function checkL()
    {
        return response(json_encode(Auth::user()),200);
    }
}
