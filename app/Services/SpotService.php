<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SpotService 
{
    public function getRecommendations()
    {
        $recommendations = DB::table('recommendations')
            ->select('spot_id', 'spots.name_es as name', 'spots.images', 'categories.name_es as category', DB::raw('count(*) as total'))
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
        $valorations = DB::table('valorations')
            ->select('spot_id', 'spots.name_es as name', 'spots.images', 'categories.name_es as category', DB::raw('cast(sum(rating) / count(*) as decimal(2,1)) as rating, count(*) as users'))
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