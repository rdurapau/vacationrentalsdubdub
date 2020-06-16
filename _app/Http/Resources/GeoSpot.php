<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GeoSpot extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "type" => "Feature",
            "geometry" => [
                "type" => "Point",
                "coordinates" => [
                    floatval($this->lng),
                    floatval($this->lat)
                ]
            ],
            "properties"=> [
                "name" => $this->name,
                "beds" => $this->beds,
                "baths" => $this->baths,
                "id" => $this->id,
                "photo" => $this->cover_photo,
                "photos" => $this->getMedia()->map(function($photo){
                    return url($photo->getUrl());
                }),
                "postal_code" => $this->postal_code,
                "price" => $this->price,
                "sleeps" => $this->sleeps,
            ]
        ];
    }
}
