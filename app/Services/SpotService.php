<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SpotService 
{
    public function getRecommendations()
    {
        $spot_name = 'spots.name_'.( request('lang') ?? "es" ).' as name';
        $category_name = 'categories.name_'.( request('lang') ?? "es" ).' as category';
        $recommendations = DB::table('recommendations')
            ->select('spot_id', $spot_name, 'spots.images', $category_name, DB::raw('count(*) as total'))
            ->join('spots', 'spots.id', '=', 'spot_id')
            ->join('categories', 'categories.id', '=', 'spots.category_id')
            ->groupBy('spot_id')
            ->orderBy('total', 'desc')
            ->take(3)
            ->get();

        foreach ($recommendations as $recommendation) {
            $recommendation->images = $this->getImages($recommendation->images);
        }

        return $recommendations;
    }

    public function getValorations()
    {
        $spot_name = 'spots.name_'.( request('lang') ?? "es" ).' as name';
        $category_name = 'categories.name_'.( request('lang') ?? "es" ).' as category';
        $valorations = DB::table('valorations')
            ->select('spot_id', $spot_name, 'spots.images', $category_name, DB::raw('cast(sum(rating) / count(*) as decimal(2,1)) as rating, count(*) as users'))
            ->join('spots', 'spots.id', '=', 'spot_id')
            ->join('categories', 'categories.id', '=', 'spots.category_id')
            ->groupBy('spot_id')
            ->orderBy('rating', 'desc')
            ->take(3)
            ->get();

        foreach ($valorations as $valoration) {
            $valoration->images = $this->getImages($valoration->images);
        }

        return $valorations;
    }

    private function getImages($path)
    {
        return array_map(function ($item) {
            return 'storage/' . $item;
        }, Storage::disk('public')->files($path));
    }
}