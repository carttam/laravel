<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\PostRequest;
use App\Models\CommentModel;
use App\Models\PostModel;
use App\Models\UserModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        return view('site.index', ['posts' => PostModel::all()]);
    }

    public function clearSession()
    {
        \Auth::logout();
        return redirect()->route('home');
    }

    public function getComments($post_id)
    {
        $result = array();
        $comments = PostModel::find($post_id);
        if ($comments instanceof PostModel) {

            foreach ($comments->comments() as $comment) {
                $result[] = ['id' => $comment->id,
                    'comment' => $comment->comment,
                    'user_full_name' => $comment->user->full_name];
            }

            return response(json_encode($result, JSON_UNESCAPED_UNICODE), 200);
        }
    }

    public function insertPost(PostRequest $request)
    {
        $msg = 'خطایی رخ داده است با پشتیبانی تماس بگیرید.';
        $status = 'failed';
        $user = LoginController::checkLogin();
        if ($user instanceof UserModel) {

            try {
                $file_path = 'upload/'.$user->secret_key . '/';
                do {
                    $file_name = Str::random(32) . '.' . $request->file('file')->getClientOriginalExtension();
                } while (Storage::exists($file_path . $file_name));

                $post = PostModel::create([
                    'description' => $request->input('description'),
                    'file_type' => $request->file('file')->getMimeType(),
                    'file_name' => $file_name,
                    'user_id' => $user->id,
                ]);

                $post->create_comment_table();
                $request->file('file')->storeAs($file_path,$file_name);
                $msg = 'پست با موفقیت اضافه شد.';
                $status = 'success';
            } catch (QueryException $ex) {
                // Do Nothing ...
            } catch (\Exception $ex) {
                // Do Nothing
            } finally {
                return redirect()->route('home')->with($status, $msg);
            }

        }
    }

    public function insertComment(CommentRequest $request)
    {
        $status = 'failed';
        $msg = 'خطایی رخ داده است با پشتیبانی تماس بگیرید .';
        try {
            $cm = (new CommentModel())->setTable('comment_' . $request->input('id'));
            $usr = LoginController::checkLogin();
            if ($usr instanceof UserModel) {
                $cm->user_id = $usr->id;
                $cm->comment = $request->input('comment');
                $cm->save();
                $status = 'success';
                $msg = 'نظر شما با موفقیت ثبت شد .';
            }
        } catch (QueryException $ex) {

        } finally {
            return redirect()->route('home')->with($status, $msg);
        }
    }
}
