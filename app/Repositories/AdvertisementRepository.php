<?php

namespace App\Repositories;

use App\Models\Advertisement;

class AdvertisementRepository extends BaseRepository
{
    const MODEL = Advertisement::class;

    public function list($perPage, $orderBy, $orderType)
    {
        $query = Advertisement::query()->with('photo');
        if (isset($orderBy) && isset($orderType)) {
            $query = $query->orderBy($orderBy, $orderType);
        }
        if (isset($perPage)) {
            return $query->paginate($perPage);
        }
        return $query->paginate();

    }

    public function getRelation($id)
    {
        $advertisement = Advertisement::query()->with(['allPhotos', 'photo'])->find($id);
        if($advertisement) {
            return $advertisement;
        }
        return false;
    }


}
