<?php

namespace App\Http\Responses;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken('newroute');

        return $request->wantsJson()
                    ? response()->json([ 'token' => $token->plainTextToken ])
                    : redirect()->intended(config('fortify.home'));
    }
}

