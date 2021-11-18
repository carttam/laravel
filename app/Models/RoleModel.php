<?php

namespace App\Models;

use App\Http\Requests\RoleRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

/**
 * @mixin Eloquent
 * */
class RoleModel extends Model
{
    use HasFactory;

    protected $table = 'role';
    protected $guarded = [
        'id',
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('user','role_id','id');
    }
}
