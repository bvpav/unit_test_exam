<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\ParkingLot;
use App\Models\Spot;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ParkingLot $parking_lot, Spot $spot)
    {
        return response()->json($spot->vehicle);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParkingLot $parking_lot, Spot $spot, VehicleRequest $request)
    {
        $vehicle = $spot->vehicle()->create($request->validated());

        return response()->json($vehicle, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ParkingLot $parking_lot, Spot $spot, Vehicle $vehicle)
    {
        return response()->json($vehicle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParkingLot $parking_lot, Spot $spot, VehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->validated());

        return response()->json($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParkingLot $parking_lot, Spot $spot, Vehicle $vehicle)
    {
        $vehicle->delete();

        return response()->json(null, 204);
    }
}
