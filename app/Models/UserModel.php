<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $guarded = [
        'id',
        'status',
    ];

    /**
     * @return HasOne
    */
    public function role()
    {
        return $this->hasOne(RoleModel::class,'id','role_id');
    }

}
