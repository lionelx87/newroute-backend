<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function recommend(Request $request)
    {
        auth()->user()->recommendations()->toggle($request->spot);
    }
}
