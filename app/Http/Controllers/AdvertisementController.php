<?php

namespace App\Http\Controllers;

use App\Helper\Response;
use App\Http\Resources\AdvertisingResource;
use App\Models\Advertisement;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;
use App\Services\AdvertisementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdvertisementController extends Controller
{

    protected $advertisementService;
    public function __construct(AdvertisementService $advertisementService)
    {
        $this->advertisementService = $advertisementService;
    }

    public function index(Request $request)
    {
        try {
            $data = $this->advertisementService->index($request->size, $request->order_by, $request->order_type);
            return Response::data($data, 'successfully',config('constant.code.reverse_code_status.CODE_SUCCESS'));
        } catch (\Exception $e) {
            return Response::dataError($e->getCode(), $e->getMessage());
        }
    }

    public function store(StoreAdvertisementRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $this->advertisementService->store($request->all());
            $data = new AdvertisingResource($data);
            DB::commit();
            return Response::data($data, 'successfully',config('constant.code.reverse_code_status.CODE_SUCCESS'));
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::dataError($e->getCode(), $e->getMessage());
        }
    }


    public function show($id)
    {
        try {
            $data = $this->advertisementService->find($id);
            $data = new AdvertisingResource($data);
            return Response::data($data, 'successfully',config('constant.code.reverse_code_status.CODE_SUCCESS'));
        } catch (\Exception $e) {
            return Response::dataError($e->getCode(), $e->getMessage());
        }
    }

}
