<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Spot;
use App\Models\Phone;

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

    public function delete($spot)
    {
        try{
            $images = $spot->images;
            $spot->delete();
            Storage::deleteDirectory('public/'.$images);
            return response()->json([
                'status' => 200
            ], 200);
        }catch(\Exception $e) {
            return response()->json([
                'status' => 500
            ], 500);
        }
    }

    public function store($request)
    {
        $spot = Spot::create([
            'name_es' => $request->name_es,
            'name_en' => $request->name_en,
            'description_es' => $request->description_es,
            'description_en' => $request->description_en,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'images' => $request->images,
            'category_id' => $request->category_id
        ]);

        $phones = strlen($request->phones) > 0 ? array_map('trim', explode(",", $request->phones)) : [];

        foreach ($phones as $phone) {
            Phone::create([
                'spot_id' => $spot->id,
                'number' => $phone
            ]);
        }

        $spot->images = $spot->id.'-'.$request->images;
        $spot->save();

        Storage::disk('local')->makeDirectory('public/'.$spot->images);

        if($request->hasFile('files')) {
            foreach($request->file('files') as $image)
            {
                Storage::disk('local')->put('public/'.$spot->images, $image);
            }
        }

        return response()->json([
            'status' => 201
        ], 201);
    }

    public function update($request, $spot)
    {
        $spot->update([
            'name_es' => $request->name_es,
            'description_es' => $request->description_es,
            'name_en' => $request->name_en,
            'description_en' => $request->description_en,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'category_id' => $request->category_id
        ]);

        $phones = strlen($request->phones) > 0 ? array_map('trim', explode(",", $request->phones)) : [];

        Phone::where('spot_id', $spot->id)->delete();

        foreach ($phones as $phone) {
            Phone::create([
                'spot_id' => $spot->id,
                'number' => $phone
            ]);
        }

        Storage::delete(Storage::allFiles('public/'.$spot->images));

        if($request->hasFile('files')) {
            foreach($request->file('files') as $image)
            {
                Storage::disk('local')->put('public/'.$spot->images, $image);
            }
        }

        if('public/'.$spot->images !== 'public/'.$spot->id.'-'.$request->images)
        {
            Storage::rename('public/'.$spot->images, 'public/'.$spot->id.'-'.$request->images);
            $spot->images = $spot->id.'-'.$request->images;
            $spot->save();
        }


        return response()->json([
            'status' => 201
        ], 201);
    }
}