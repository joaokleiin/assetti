<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\MaintenanceResource;
use App\Models\Maintenance;

class MaintenanceController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $maintenances = Maintenance::with(['equipment'])->get();

        return MaintenanceResource::collection($maintenances);
    }

    public function show(int $id): MaintenanceResource|\Illuminate\Http\JsonResponse
    {
        $maintenance = Maintenance::with(['equipment', 'user'])->find($id);

        if (! $maintenance) {
            return $this->notFoundResponse();
        }

        return new MaintenanceResource($maintenance);
    }
}
