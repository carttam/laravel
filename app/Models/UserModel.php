<?php

namespace App\Models;

use App\Http\Requests\UserRequest;
use Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Eloquent;
use Laravel\Passport\HasApiTokens;

/**
 * @mixin Eloquent
 * */
class UserModel extends Model implements Authenticatable
{
    use HasFactory,HasApiTokens;

    protected $table = 'user';
    protected $guarded = [
        'id',
        'status',
        'remember_token',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return HasOne
     */
    public function role()
    {
        return $this->hasOne(RoleModel::class, 'id', 'role_id');
    }

    public static function insertUser(UserRequest $request)
    {
        $msg = '';
        $status = '';
        try {
            $usr = UserModel::create($request->all());
            do {
                $secret_key = Str::random('16');
            } while (UserModel::where('secret_key', $secret_key)->get()->count() > 0);
            $usr->secret_key = $secret_key;
            $usr->save();
            $msg = 'کاربر ' . $usr->full_name . ' با موفقیت اضافه شد .';
            $status = 'success';
        } catch (QueryException $ex) {
            $msg = 'خطایی رخ داده است با پشتیبانی تماس بگیرید .';
            $status = 'failed';
        } finally {
            return ['msg' => $msg,
                'status' => $status];
        }
    }

    public function setPasswordAttribute($val)
    {
        $this->attributes['password'] = Hash::make($val);
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
