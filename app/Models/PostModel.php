<?php

namespace App\Models;

use App\Http\Requests\PostRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Eloquent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @mixin Eloquent
 * */
class PostModel extends Model
{
    use HasFactory;

    protected $table = 'post';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->hasOne(UserModel::class,'id','user_id');
    }

    public function comments()
    {
        return (new CommentModel())->setTable('comment_'.$this->id)->get();
    }

    public function create_comment_table(){
        Schema::create('comment_'.$this->id, function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });
    }
}
