<?php

namespace App\Http\Resources;

use App\BaseSpot;
use Illuminate\Http\Resources\Json\JsonResource;

class Spot extends JsonResource
{

    protected $extended;

    public function __construct(BaseSpot $spot, $extended = NULL)
    {
        parent::__construct($spot);
        $this->extended = $extended;
    }

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
            "name" => $this->name,
            "pets" => $this->allowsPets(),
            "postal_code" => $this->postal_code,
            "phone" => $this->phone,
            "photo" => $this->cover_photo,
            "beds" => $this->beds,
            "price" => $this->price,
            "sleeps" => $this->sleeps,
            "lat" => $this->lat,
            "lng" => $this->lng,
            "state" => $this->state,
            "website" => $this->website,
            'amenities' => Amenity::collection($this->whenLoaded('amenities')),
            'all_photos' => SpotPhoto::collection($this->getMedia()),
            'photos' => $this->getMedia()->map(function($photo){
                return url($photo->getUrl());
            }),
            'other_photos' => $this->other_photos,
            $this->mergeWhen($this->extended, [
                "email" => $this->email,
                "owner_name" => $this->owner_name,
                "address1" => $this->address1
            ]),
        ];
    }
}
