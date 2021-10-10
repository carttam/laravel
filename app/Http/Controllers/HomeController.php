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

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function displayImage($postID)

    {
        if (ctype_digit($postID)) {
            $post = PostModel::find($postID);
            $path = storage_path('app/upload/').$post->user->secret_key.'/'.$post->file_name;
            if (!\File::exists($path)) {

                abort(404);

            }
            $file = \File::get($path);
            $type = \File::mimeType($path);
            $response = \Response::make($file, 200);
            $response->header("Content-Type", $type);

            return $response;

        }
        return null;
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
            return response(json_encode($result, JSON_UNESCAPED_UNICODE), 200,['Access-Control-Allow-Origin'=>'*',]);
        }
    }

    public function insertPost(PostRequest $request)
    {
        $msg = 'خطایی رخ داده است با پشتیبانی تماس بگیرید.';
        $status = 'failed';
        if (\Auth::check()) {
            $user = \Auth::user();
            try {
                $file_path = 'upload/' . $user->secret_key . '/';
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
                $request->file('file')->storeAs($file_path, $file_name);
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
            if (\Auth::check()) {
                $usr = \Auth::user();
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
