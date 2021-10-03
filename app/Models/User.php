<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'dob',
        'email',
        'phone',
        'address',
        'password',
        'mobile',
        'avatar',
        'username',
        'website',
        'bio',
        'mobile_verified_at',
        'user_type',
        'provider_id',
        'provider',
        'access_token',
        'is_email_verified',
        'is_phone_verified',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getMiddleNameAttribute($value)
    {
        if($value == 'null' || $value == null || $value == NULL)
            return null;
        else
            return $value;
    }

    public function getLastNameAttribute($value)
    {
        if($value == 'null' || $value == null || $value == NULL)
            return null;
        else
            return $value;
    }

    public function getGenderAttribute($value)
    {
        if($value == '' || $value == 'null' || $value == null || $value == NULL)
            return '';
        else
            return $value;
    }

    public function getDobAttribute($value)
    {
        if($value == '0000-00-00' || $value == 'null' || $value == null || $value == NULL)
            return '';
        else
            return $value;
    }

    public function getCreatedAtAttribute($value)
    {
        return $value->format('Y-m-d H:i:s');
        // return date('Y-m-d H:i:s', strtotime($value));
    }
}
