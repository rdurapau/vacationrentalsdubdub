<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TempMedia extends JsonResource
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
            "media_id" => $this->getFirstMedia()->id,
            "name" => $this->getFirstMedia()->name,
            "file_name" => $this->getFirstMedia()->file_name,
            "size" => $this->getFirstMedia()->size
        ];
    }
}
