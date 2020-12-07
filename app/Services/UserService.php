<?php

namespace App\Services;

class UserService 
{
    public function recommend($spot)
    {
        auth()->user()->recommendations()->toggle($spot);
    }

    public function rate($spot, $valoration)
    {
        auth()->user()->valorations()->detach($spot);
        auth()->user()->valorations()->attach($spot, ['rating' => $valoration]);
    }

    public function comment($spot, $message)
    {
        auth()->user()->comments()->attach($spot, ['message' => $message]);
    }

    public function checkOptions($spot)
    {
        $recommend = auth()->user()->recommendations()->wherePivot('spot_id', $spot)->first();
        $valoration = auth()->user()->valorations()->where('spot_id', $spot)->first();
        return response()->json([
            'recommended' => !empty($recommend),
            'valoration' => !empty($valoration) ? $valoration->pivot->rating : 0
        ], 200);
    }
}