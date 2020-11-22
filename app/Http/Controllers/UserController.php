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

    public function checkOptions(Request $request)
    {
        $recommend = auth()->user()->recommendations()->wherePivot('spot_id', $request->spot)->first();

        return response()->json([
            'recommended' => !empty($recommend)
        ], 200);
    }
}
