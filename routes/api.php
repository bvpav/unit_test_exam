<?php

use App\Http\Controllers\ParkingLotController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::apiResource('parking-lots', ParkingLotController::class);
Route::apiResource('parking-lots.spots', SpotController::class);
Route::apiResource('parking-lots.spots.vehicles', VehicleController::class);
