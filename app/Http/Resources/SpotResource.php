<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'name' => $this->name_es,
            'description' => $this->description_es,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'images' => $this->images
        ];
    }
}
