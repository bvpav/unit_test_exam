<?php

namespace App\Http\Controllers;

use App\Http\Requests\LicenseRequest;
use App\Http\Requests\UpdateLicenseRequest;
use App\Models\Citizen;
use App\Models\License;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Citizen $citizen)
    {
        return response()->json($citizen->licenses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LicenseRequest $request)
    {
        $license = License::create($request->validated());

        return response()->json($license, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(License $license)
    {
        return response()->json($license);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LicenseRequest $request, License $license)
    {
        $license->update($request->validated());

        return response()->json($license);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(License $license)
    {
        $license->delete();

        return response()->json(null, 204);
    }
}
