<?php

namespace App\Services;

use App\Repositories\AdvertisementPhotoRepository;
use App\Repositories\AdvertisementRepository;

class AdvertisementService
{
    protected $advertisementRepository;
    protected $advertisementPhotoRepository;

    public function __construct(AdvertisementRepository $advertisementRepository, AdvertisementPhotoRepository $advertisementPhotoRepository)
    {
        $this->advertisementRepository = $advertisementRepository;
        $this->advertisementPhotoRepository = $advertisementPhotoRepository;
    }

    public function index($size, $orderBy, $orderType) {
        return $this->advertisementRepository->index($size, $orderBy, $orderType);
    }

    public function store($rq) {
        $advertisementStoreData = ['description' => $rq['description'], 'name' => $rq['name'], 'price' => $rq['price']];
        $advertisement = $this->advertisementRepository->create($advertisementStoreData);
        $linkList = $rq['images'];
        $advertisementPhotoStoreData = [];
        foreach ($linkList as $key => $value) {
            $data = ['image_link' => $value, 'advertisement_id' => $advertisement->id];
            array_push($advertisementPhotoStoreData, $data);
        }
        $this->advertisementPhotoRepository->insert($advertisementPhotoStoreData);
        return $this->advertisementRepository->getRelation($advertisement->id);
    }

    public function find($id) {
        return $this->advertisementRepository->getRelation($id);
    }
}
