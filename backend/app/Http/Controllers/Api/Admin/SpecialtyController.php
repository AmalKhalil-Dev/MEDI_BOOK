<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSpecialtyRequest;
use App\Http\Requests\UpdateSpecialtyRequest;
use App\Http\Resources\SpecialtyResource;
use App\Models\Specialty;
use Illuminate\Http\JsonResponse;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $specialties = Specialty::orderBy('id', 'desc')->paginate(10);

        return response()->json([
            'message' => 'Specialties retrieved successfully.',
            'data' => SpecialtyResource::collection($specialties),
            'pagination' => [
                'current_page' => $specialties->currentPage(),
                'last_page' => $specialties->lastPage(),
                'per_page' => $specialties->perPage(),
                'total' => $specialties->total(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecialtyRequest $request): JsonResponse
    {
        $specialty = Specialty::create($request->validated());

        return response()->json([
            'message' => 'Specialty created successfully.',
            'data' => new SpecialtyResource($specialty),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialty $specialty): JsonResponse
    {
        return response()->json([
            'message' => 'Specialty retrieved successfully.',
            'data' => new SpecialtyResource($specialty),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateSpecialtyRequest $request,
        Specialty $specialty
    ): JsonResponse {

        $specialty->update($request->validated());

        return response()->json([
            'message' => 'Specialty updated successfully.',
            'data' => new SpecialtyResource($specialty),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialty $specialty): JsonResponse
    {
        $specialty->delete();

        return response()->json([
            'message' => 'Specialty deleted successfully.',
        ], 200);
    }
}
