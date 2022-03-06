<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\ResetPassword;
use Carbon\Carbon;
use App\Notifications\APIPasswordResetNotification;
use Hash;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    // PASO 1
    public function sendPasswordResetToken(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users,email'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return $validator->errors()->all();
        }
        
        $data = $validator->validated();
        $user = User::where('email', $data['email'])->first();
        $reset_link_sent = $this->sendPasswordResetLink($user);
        if($reset_link_sent) 
        {
            return response()->json([
                'status' => 200,
                'message' => 'se ha enviado un token de restablecimiento de contraseña a su correo electrónico'
            ]);
        }
        return response()->json([
            'status' => 502,
            'message' => 'no se ha podido enviar el token de restablecimiento de contraseña. Por favor intente nuevamente en unos segundos'
        ]);
    }

     private function sendPasswordResetLink($user)
    {
        do {
            $token = Str::random(8);
            $signature = hash('md5', $token);
            $exists = ResetPassword::where([
                [ 'user_id', $user->id],
                [ 'token_signature', $signature ]
            ])->exists();
        }while($exists);

        try {
            $user->notify(new APIPasswordResetNotification($token));
            return ResetPassword::create([
                'user_id' => $user->id,
                'token_signature' => $signature,
                'expires_at' => Carbon::now()->addMinutes(30),
            ]);
        }catch (\Throwable $th) {
            return $th;
        }
    }

    // PASO 2
    public function validatePasswordResetToken(Request $data)
    {
        $resetToken = ResetPassword::where([
            ['token_signature', hash('md5', $data['password_reset_code'])],
            ['token_type', '10']
        ])->first();
        if($resetToken === null || $resetToken->count() <= 0)
        {
            return 'Invalid password reset code';
        }
        if(Carbon::now()->greaterThan($resetToken->expires_at))
        {
            return 'the password reset code given has expired';
        }
        // $reset_token = $resetToken->getResetIdentifierCode(); // completar
        $reset_token = $this->getResetIdentifierCode(); // completar
        return $reset_token;
        // if($reset_token)
        // {
        //     $resetToken->update([
        //         'expires_at' => Carbon::now(),
        //     ]);
        //     return [
        //         'token' => $reset_token
        //     ];
        // }else {
        //     return 'error!';
        // }
    }

    private function getResetIdentifierCode()
    {
        $token = 'V95867';
        try {
            ResetPassword::create([
                'user_id' => 5,
                'token_signature' => hash('md5', $token),
                'used_token' => 2,
                'token_type' => 11,
                'expires_at' => Carbon::now()->addMinutes(30),
            ]);
            return $token;
        }catch(\Throwable $th) {
            return $th;
        }
    }

    public function setNewAccountPassword(Request $request)
    {
        $rules = [
            'token' => 'required|string|max:8',
            'password' => 'required|confirmed|string|max:45',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            return $validator->errors()->all();
        }
        $data = $validator->validated();
        
        $verifyToken = ResetPassword::where([
            [ 'token_signature', hash('md5', $data['token']) ],
            [ 'token_type', 11 ]
        ])->get();

        if($verifyToken === null || $verifyToken->count() <= 0)
        {
            return 'Invalid token for resetting password';
        }
        
        $user = User::where([
            [ 'id', $verifyToken[0]->user_id ]
        ])->first();

        if($user === null)
        {
            return 'token does not correspond to any existing user';
        }else if (Carbon::now()->greaterThan($verifyToken[0]->expires_at))
        {
            return 'the reset password token has expired';
        }
        $new_password = Hash::make($data['password']);
        $user->password = $new_password;
        $user->save();
        $verifyToken[0]->update([
            'expires_at' => Carbon::now()
        ]);



        return $user;
        
    }

    
}
