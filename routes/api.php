<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvertisementController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'advertisement'], function () {
    Route::get('/', [AdvertisementController::class, 'list']);
    Route::post('/', [AdvertisementController::class, 'create']);
    Route::get('/{id}', [AdvertisementController::class, 'show']);
});

