<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisingResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'photo' => $this->photo,
            'all_photo' => $this->allPhoto,
            'description' => $this->description,
        ];
    }
}
