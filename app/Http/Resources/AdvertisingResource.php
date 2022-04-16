<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisingResource extends JsonResource
{

    public function toArray($request)
    {
        $linkPhotoList = [];
        foreach ($this->allPhotos as  $photo){
            $linkPhotoList[] = $photo->photo_link;
        }
        return [
            'name' => $this->name,
            'price' => $this->price,
            'main_photo' => ($this->photo && $this->photo->photo_link) ? $this->photo->photo_link : null,
            'all_photos' => $linkPhotoList,
            'description' => $this->description,
        ];
    }
}
