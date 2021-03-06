<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * @mixin Eloquent
 * */
class CommentModel extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = ['id',];

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserModel::class,'id','user_id');
    }
}
