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

    public function rate(Request $request)
    {
        auth()->user()->valorations()->detach($request->spot);

        auth()->user()->valorations()->attach($request->spot, [ 'rating' => $request->valoration ]);
    }

    public function checkOptions(Request $request)
    {
        $recommend = auth()->user()->recommendations()->wherePivot('spot_id', $request->spot)->first();

        $valoration = auth()->user()->valorations()->where('spot_id', $request->spot)->first();

        return response()->json([
            'recommended' => !empty($recommend),
            'valoration' => !empty($valoration) ? $valoration->pivot->rating : 0
        ], 200);
    }
}
