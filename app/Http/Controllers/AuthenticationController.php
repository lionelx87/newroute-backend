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
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 500);
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
        ], 500);
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
            ['token_type', ResetPassword::PASSWORD_RESET_TOKEN]
        ])->first();
        if($resetToken === null || $resetToken->count() <= 0)
        {
            return response()->json([
                'status' => 404,
                'message' => 'invalid password reset code'
            ], 500);
        }
        if(Carbon::now()->greaterThan($resetToken->expires_at))
        {
            return response()->json([
                'status' => 404,
                'message' => 'the password reset code given has expired'
            ], 500);
        }
        $reset_token = $this->getResetIdentifierCode($resetToken);
        if($reset_token)
        {
            $resetToken->update([
                'expires_at' => Carbon::now(),
            ]);
            return response()->json([
                'token' => $reset_token
            ]);
        }else {
            return response()->json([
                'status' => 404,
                'message' => 'an error occurred while generating the token'
            ], 500);
        }
    }

    private function getResetIdentifierCode($resetToken)
    {
        $token = Str::random(100);
        try {
            ResetPassword::create([
                'user_id' => $resetToken->user_id,
                'token_signature' => hash('md5', $token),
                'used_token' => $resetToken->id,
                'token_type' => ResetPassword::PASSWORD_VERIFY_TOKEN,
                'expires_at' => Carbon::now()->addMinutes(30),
            ]);
            return $token;
        }catch(\Throwable $th) {
            return $th;
        }
    }

    // PASO 3
    public function setNewAccountPassword(Request $request)
    {
        $rules = [
            'token' => 'required|string|max:100',
            'password' => 'required|confirmed|string|max:45',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 500);
        }
        $data = $validator->validated();
        
        $verifyToken = ResetPassword::where([
            [ 'token_signature', hash('md5', $data['token']) ],
            [ 'token_type', ResetPassword::PASSWORD_VERIFY_TOKEN ]
        ])->get();

        if($verifyToken === null || $verifyToken->count() <= 0)
        {
            return response()->json([
                'status' => 404,
                'message' => 'invalid token for resetting password'
            ], 500);
        }
        
        $user = User::where([
            [ 'id', $verifyToken[0]->user_id ]
        ])->first();

        if($user === null)
        {
            return response()->json([
                'status' => 404,
                'message' => 'token does not correspond to any existing user'
            ], 500);
        }else if (Carbon::now()->greaterThan($verifyToken[0]->expires_at))
        {
            return response()->json([
                'status' => 404,
                'message' => 'the reset password token has expired'
            ], 500);
        }
        $new_password = Hash::make($data['password']);
        $user->password = $new_password;
        $user->save();
        $verifyToken[0]->update([
            'expires_at' => Carbon::now()
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'password was successfully reset'
        ]);
    }    
}
