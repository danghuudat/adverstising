<?php

namespace App\Services;

use App\Repositories\AdvertisementPhotoRepository;
use App\Repositories\AdvertisementRepository;
use Carbon\Carbon;

class AdvertisementService
{
    protected $advertisementRepository;
    protected $advertisementPhotoRepository;

    public function __construct(AdvertisementRepository $advertisementRepository, AdvertisementPhotoRepository $advertisementPhotoRepository)
    {
        $this->advertisementRepository = $advertisementRepository;
        $this->advertisementPhotoRepository = $advertisementPhotoRepository;
    }

    public function list($perPage, $orderBy, $orderType) {
        return $this->advertisementRepository->list($perPage, $orderBy, $orderType);
    }

    public function store($rq) {
        $advertisementStoreData = ['description' => $rq['description'], 'name' => $rq['name'], 'price' => $rq['price']];
        $advertisement = $this->advertisementRepository->create($advertisementStoreData);
        $linkList = $rq['photos'];
        $advertisementPhotoStoreData = [];
        foreach ($linkList as $key => $value) {
            $isMain = ($key == 0) ? 1 : 0;
            $data = [
                'photo_link' => $value,
                'advertisement_id' => $advertisement->id,
                'is_main' => $isMain
            ];
            $advertisementPhotoStoreData[] = $data;
        }
        $this->advertisementPhotoRepository->insert($advertisementPhotoStoreData);
        return $advertisement->id;
    }

    public function find($id) {
        return $this->advertisementRepository->getRelation($id);
    }
}
