<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdvertisementRequest;
use App\Http\Resources\AdvertisingResource;
use App\Http\Resources\ListAdvertisingResource;
use App\Http\Requests\GetAdvertisementRequest;
use App\Services\AdvertisementService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response as HttpResponse;
use App\Helper\Response;


class AdvertisementController extends Controller
{

    protected $advertisementService;
    public function __construct(AdvertisementService $advertisementService)
    {
        $this->advertisementService = $advertisementService;
    }

    public function list(GetAdvertisementRequest $request)
    {
        try {
            $data = $this->advertisementService->list($request->get('per_page'), $request->get('order_by'), $request->get('order_type'));
            $data = ListAdvertisingResource::collection($data);
            return Response::data($data, HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            return Response::dataError($e->getCode(), $e->getMessage());
        }
    }

    public function store(StoreAdvertisementRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $this->advertisementService->store($request->all());
            DB::commit();
            return Response::data($data, HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::dataError($e->getCode(), $e->getMessage());
        }
    }


    public function show($id)
    {
        try {
            $data = $this->advertisementService->find($id);
            if($data == false) {
                return Response::dataError(HttpResponse::HTTP_NOT_FOUND, 'NOT FOUND');
            }
            $data = new AdvertisingResource($data);
            return Response::data($data, HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            return Response::dataError($e->getCode(), $e->getMessage());
        }
    }

}
