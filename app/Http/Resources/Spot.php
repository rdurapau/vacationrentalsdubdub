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
            "baths" => $this->baths,
            "city" => $this->city,
            "desc" => $this->desc,
            "email" => $this->email,
            "name" => $this->name,
            "pets" => $this->allowsPets(),
            "postal_code" => $this->postal_code,
            "phone" => $this->phone,
            "photo" => $this->cover_photo,
            "beds" => $this->beds,
            "price" => $this->price,
            "sleeps" => $this->sleeps,
            "state" => $this->state,
            "website" => $this->website,
            'amenities' => Amenity::collection($this->whenLoaded('amenities')),
            'photos' => $this->getMedia()->map(function($photo){
                return url($photo->getUrl());
            })
        ];
    }
}
