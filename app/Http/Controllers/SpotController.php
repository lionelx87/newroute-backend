<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpotCollection;
use App\Http\Resources\SpotResource;
use App\Models\Spot;
use Illuminate\Http\Request;

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
    
}
