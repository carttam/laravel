<?php

namespace App\Models;

use App\Http\Requests\UserRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Eloquent;

/**
 * @mixin Eloquent
 * */
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

    public static function insertUser(UserRequest $request){
        $msg = '';
        $status = '';
        try {
            $usr = UserModel::create($request->all());
            do{
                $secret_key = Str::random('16');
            }while(UserModel::where('secret_key',$secret_key)->get()->count() > 0);
            $usr->secret_key = $secret_key;
            $usr->save();
            $msg = 'کاربر ' . $usr->full_name . ' با موفقیت اضافه شد .' ;
            $status = 'success';
        }catch (QueryException $ex){
            $msg = 'خطایی رخ داده است با پشتیبانی تماس بگیرید .';
            $status = 'failed';
        } finally {
            return ['msg'=>$msg,
                'status'=>$status];
        }
    }
}
