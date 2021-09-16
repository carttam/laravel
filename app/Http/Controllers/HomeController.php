<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('site.index', ['posts' => PostModel::all()]);
    }

    public function getComments($post_id)
    {
        $result = array();
        $comments = PostModel::find($post_id);
        if ($comments instanceof PostModel) {

            foreach ($comments->comments() as $comment){
                $result[] = ['id'=>$comment->id,
                    'comment'=>$comment->comment,
                    'user_full_name'=>$comment->user->full_name];
            }

            return response(json_encode($result, JSON_UNESCAPED_UNICODE), 200);
        }
    }
}
