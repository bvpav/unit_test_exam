<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpotRequest;
use App\Models\ParkingLot;
use App\Models\Spot;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ParkingLot $parking_lot)
    {
        return response()->json($parking_lot->spots);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParkingLot $parking_lot, SpotRequest $request)
    {
        $spot = $parking_lot->spots()->create($request->validated());

        return response()->json($spot, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Spot $spot)
    {
        return response()->json($spot);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SpotRequest $request, Spot $spot)
    {
        $spot->update($request->validated());

        return response()->json($spot);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spot $spot)
    {
        $spot->delete();

        return response()->json(null, 204);
    }
}
