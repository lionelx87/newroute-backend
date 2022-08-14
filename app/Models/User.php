<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements CanResetPasswordContract 
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function visits()
    {
        return $this->belongsToMany(Spot::class, 'visits')->withPivot('id')->withTimestamps(); // syncWithoutDetacking - detach 
    }

    public function recommendations()
    {
        return $this->belongsToMany(Spot::class, 'recommendations')->withTimestamps(); // syncWithoutDetacking - detach
    }

    public function valorations() 
    {
        return $this->belongsToMany(Spot::class, 'valorations')->withPivot('rating')->withTimestamps(); // attach($id, [ 'rating' => 5 ]) - detach($id)
    }

    public function comments()
    {
        return $this->belongsToMany(Spot::class, 'comments')->withPivot('message')->withTimestamps(); // attach($id, [ 'rating' => 5 ]) - detach($id)
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // public function sendPasswordResetLink()
    // {
    //     do {
    //         // $token = $this->getResetCode();
    //         $token = 'V95865';
    //         $signature = hash('md5', $token);
    //         $exists = $this->where([
    //             [ 'user_id', $this->id],
    //             [ 'token_signature', $signature ]
    //         ])->exists();
    //     }while($exists);
    // }

}
