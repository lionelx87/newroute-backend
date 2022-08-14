<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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

    public function getOpinions($spot)
    {
        $recommend = auth()->user()->recommendations()->wherePivot('spot_id', $spot)->first();
        $valoration = auth()->user()->valorations()->where('spot_id', $spot)->first();
        return response()->json([
            'recommended' => !empty($recommend),
            'valoration' => !empty($valoration) ? $valoration->pivot->rating : 0
        ], 200);
    }

    public function visits($visits)
    {
        foreach (json_decode($visits) as $visit) {
            $last_visit = auth()->user()->visits->where('id', $visit)->last();
            if(!empty($last_visit))
            {
                $isToday = Carbon::parse($last_visit->pivot->created_at)->isToday();
                if($isToday) {
                    auth()->user()->visits()->wherePivot('id', $last_visit->pivot->id)->detach();
                }
            }
            auth()->user()->visits()->attach($visit);
        }
    }

    public function getVisits()
    {
        $user_id = auth()->user()->id;
        $visits = auth()->user()->visits()->wherePivot('user_id', $user_id)->get();
        foreach ($visits as $visit) {
            $visit->images = $this->getImages($visit->images);
        }
        return response()->json([
            // TODO: send less information
            'visits' => $visits
        ]);
    }

    private function getImages($path)
    {
        return array_map(function ($item) {
            return 'storage/' . $item;
        }, Storage::disk('public')->files($path));
    }
}