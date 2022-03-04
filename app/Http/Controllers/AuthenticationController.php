<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\ResetPassword;
use Carbon\Carbon;
use App\Notifications\APIPasswordResetNotification;

class AuthenticationController extends Controller
{
    public function sendPasswordResetToken(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users,email'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            // return $this->errorMessage(true, $validator->errors()->all());
            return $validator->errors()->all();
        }
        
        $data = $validator->validated();
        $user = User::where('email', $data['email'])->first();
        $reset_link_sent = $this->sendPasswordResetLink($user);
        return $reset_link_sent;

    }

     public function sendPasswordResetLink($user)
    {
        do {
            // $token = $this->getResetCode();
            $token = 'V95865';
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

    
}
