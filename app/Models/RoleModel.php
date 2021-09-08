<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;

    protected $table = 'role';
    protected $guarded = [
        'id',
    ];

    public function user()
    {
        return $this->belongsTo('user','role_id','id');
    }
}
