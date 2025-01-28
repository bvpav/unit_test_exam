<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Models\Album;
use App\Models\Photo;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Album $album)
    {
        return response()->json($album->photos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Album $album, PhotoRequest $request)
    {
        $album->photos()->create($request->validated());

        return response()->json($album->photos, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        return response()->json($photo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PhotoRequest $request, Photo $photo)
    {
        $photo->update($request->validated());

        return response()->json($photo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();

        return response()->json(null, 204);
    }
}
