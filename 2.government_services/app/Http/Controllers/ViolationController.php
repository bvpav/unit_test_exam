<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateViolationRequest;
use App\Http\Requests\ViolationRequest;
use App\Models\License;
use App\Models\Violation;

class ViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(License $license)
    {
        return response()->json($license->violations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(License $license, ViolationRequest $request)
    {
        $violation = $license->violations()->create($request->validated());

        return response()->json($violation, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Violation $violation)
    {
        return response()->json($violation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ViolationRequest $request, Violation $violation)
    {
        $violation->update($request->validated());

        return response()->json($violation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Violation $violation)
    {
        $violation->delete();

        return response()->json(null, 204);
    }
}
