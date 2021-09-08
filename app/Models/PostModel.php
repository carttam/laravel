<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostModel extends Model
{
    use HasFactory;

    protected $table = 'post';
    protected $guarded = [
        'id',
    ];

    public function comments(): \Illuminate\Database\Query\Builder
    {
        return DB::table('comment_'.$this->id);
    }
}
