<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpotPhoto extends JsonResource
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
            "url" => $this->getFullUrl(),
            "thumbnail" => $this->getFullUrl('thumb'),
            "name" => $this->name,
            "size" => $this->size,
            "type" => $this->mime_type,
            "order_column" => $this->order_column
        ];
    }
}
