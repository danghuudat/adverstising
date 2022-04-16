<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListAdvertisingResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'main_photo' => ($this->photo && $this->photo->photo_link) ? $this->photo->photo_link : null,
        ];
    }
}
