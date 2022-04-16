<?php

namespace App\Repositories;
use App\Models\Advertisement;

class AdvertisementRepository extends BaseRepository
{
    const MODEL = Advertisement::class;

    public function index($size = 10, $orderBy, $orderType){
        $query = Advertisement::query()->with(['photo', 'allPhoto']);
        if (isset($orderBy) && $orderBy != null) {
            if($orderBy == 'price' || $orderBy == 'created_at') {
                if($orderType == 'desc' || $orderType == 'asc') {
                    $query = $query->orderBy($orderBy, $orderType);
                }
            }
        }
        return $query->paginate($size);
    }

    public function getRelation($id){
        return Advertisement::query()->with(['allPhoto', 'photo'])->find($id);
    }


}
