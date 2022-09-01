<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Models\Valoration;

class SpotResource extends JsonResource
{

    // private $foo;

    // public function __construct($resource, $foo)
    // {
    //     // Ensure you call the parent constructor
    //     parent::__construct($resource);
    //     $this->resource = $resource;

    //     $this->foo = $foo;
    // }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this["name_".($request->lang ?? "es")],
            'description' => $this["description_".($request->lang ?? "es")],
            'category' => new CategoryResource($this->category),
            'address' => $this->address,
            'phones' => new PhoneCollection($this->phones),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'images' => $this->getImages($this->images),
            'valoration' => $this->valoration,
            'comments' => $this->comments
        ];
    }

    private function getImages($path) {
        return array_map(function($item){
            return 'storage/' . $item;
        }, Storage::disk('public')->files($path));
    }
}
