<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    use HasFactory;

    public const PASSWORD_RESET_TOKEN = 10;
    public const PASSWORD_VERIFY_TOKEN = 11;

    protected $table = 'api_password_reset_token';

    protected $fillable = [
        'user_id',
        'token_signature',
        'used_token',
        'token_type',
        'expires_at'
    ];

}
