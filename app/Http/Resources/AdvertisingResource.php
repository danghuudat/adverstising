<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisingResource extends JsonResource
{

    public function toArray($request)
    {
        $returnData = [
            'name' => $this['data']->name,
            'price' => $this['data']->price,
            'main_photo' => ($this['data']->photo && $this['data']->photo->photo_link) ? $this['data']->photo->photo_link : null,
        ];
        $linkPhotoList = [];
        foreach ($this['data']->allPhotos as  $photo){
            $linkPhotoList[] = $photo->photo_link;
        }
        if(isset($this['request']['fields'])) {
            if(in_array("link", $this['request']['fields'])) {
                $returnData['all_photos'] = $linkPhotoList;
            }
            if(in_array("description", $this['request']['fields'])) {
                $returnData['description'] = $this['data']->description;
            }
        }
        return $returnData;
    }
}
