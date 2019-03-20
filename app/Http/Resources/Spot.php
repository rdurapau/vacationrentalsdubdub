<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class Spot extends JsonResource
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
            "address" => $this->address1,
            "baths" => $this->baths,
            "city" => $this->city,                      
            "name" => $this->name,
            // "photo" => "https://picsum.photos/300/200?image={$this->id}",
            "postal_code" => $this->postal_code,
            "price" => $this->price,
            "sleeps" => $this->sleeps,
            "state" => $this->state,
            "photo" => $this->cover_photo,
            "pets" => $this->allowsPets(),
            'amenities' => Amenity::collection($this->whenLoaded('amenities')),
        ];
    }
}
