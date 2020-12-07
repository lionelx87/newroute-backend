<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpotCollection;
use App\Http\Resources\SpotResource;
use App\Models\Spot;
use App\Models\Recommendation;
use App\Services\SpotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SpotController extends Controller
{
    protected $spot_service;

    public function __construct()
    {
        $this->spot_service = new SpotService();
    }
    

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
        return $this->spot_service->getRecommendations();
    }
    
}
