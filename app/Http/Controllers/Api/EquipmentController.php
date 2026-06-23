<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $equipments = Equipment::with(['category', 'brand', 'sector'])->get();

        return EquipmentResource::collection($equipments);
    }

    public function show(int $id): EquipmentResource|\Illuminate\Http\JsonResponse
    {
        $equipment = Equipment::with(['category', 'brand', 'sector', 'maintenances'])->find($id);

        if (! $equipment) {
            return $this->notFoundResponse();
        }

        return new EquipmentResource($equipment);
    }
}
