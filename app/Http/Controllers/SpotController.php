<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpotCollection;
use App\Http\Resources\SpotResource;
use App\Models\Spot;
use App\Models\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SpotController extends Controller
{

    public function index()
    {
        return new SpotCollection(Spot::all());
    }

    public function show(Spot $spot)
    {
        return new SpotResource($spot);
    }

    public function recommendations()
    {
        $results = DB::table('recommendations')
                    ->select('spot_id', 'spots.name_es as name', 'spots.images', 'categories.name_es as category', DB::raw('count(*) as total'))
                    ->join('spots', 'spots.id', '=', 'spot_id')
                    ->join('categories', 'categories.id', '=', 'spots.category_id')
                    ->groupBy('spot_id')
                    ->orderBy('total', 'desc')
                    ->take(3)
                    ->get();

        foreach ($results as $result) {
            $result->images = $this->getImages($result->images);
        }

        return $results;
    }

    private function getImages($path)
    {
        return array_map(function ($item) {
            return 'storage/' . $item;
        }, Storage::disk('public')->files($path));
    }
    
}
