<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable implements MustVerifyEmail

{
    use HasApiTokens , HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'lname',
        'password',
        'username',
        'gender',
        'national_id',
        'phone_number',
        'email',
        'image',
        'city',
        'street',
        'overview',
        'job',
        'university',
        'specialization',
        'experience',
        'rate',
        'credit',
        'type',
        'category_id',

    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function skills(){
        return $this->belongsToMany(Skill::class);
    }

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


   /* public function getImageAttribute($value)
    {
        return url('storage/'.$value);
    }*/

    public function sendPasswordResetNotification($token)
    {

        $url = 'https://spa.test/reset-password?token=' . $token;

        $this->notify(new ResetPasswordNotification($url));
    }


}
