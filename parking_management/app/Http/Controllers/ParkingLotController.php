<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParkingLotRequest;
use App\Models\ParkingLot;

class ParkingLotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ParkingLot::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParkingLotRequest $request)
    {
        $parking_lot = ParkingLot::create($request->validated());

        return response()->json($parking_lot, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ParkingLot $parkingLot)
    {
        return response()->json($parkingLot);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParkingLotRequest $request, ParkingLot $parkingLot)
    {
        $parkingLot->update($request->validated());

        return response()->json($parkingLot);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParkingLot $parkingLot)
    {
        $parkingLot->delete();

        return response()->json(null, 204);
    }
}
