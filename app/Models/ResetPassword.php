<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    use HasFactory;

    protected $table = 'api_password_reset_token';

    protected $fillable = [
        'user_id',
        'token_signature',
        'used_token',
        'token_type',
        'expires_at'
    ];

}
