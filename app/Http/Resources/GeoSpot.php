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
            "type"=> "Feature",
            "geometry"=> [
                "type"=> "Point",
                "coordinates"=> [
                    floatval($this->lng),
                    floatval($this->lat)
                ]
            ],
            "properties"=> [
                // "name" => $this->name,
                "price" => $this->price,
                // "address" => $this->address1,
                // "city" => $this->city,
                // "state" => $this->state,
                "postal_code" => $this->postal_code,
                "id" => $this->id,
                "photo" => "https://picsum.photos/300/200?image={$this->id}",
                "pets" => rand(0,1),
                "sleeps" => rand(2,20),
                "baths" => rand(1,3)
            ]
        ];
    }
}
