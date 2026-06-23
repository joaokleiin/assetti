<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'equipment' => $this->equipment ? [
                'id' => $this->equipment->id,
                'name' => $this->equipment->name,
                'asset_number' => $this->equipment->asset_number,
            ] : null,
            'maintenance_type' => $this->maintenance_type,
            'maintenance_date' => optional($this->maintenance_date)->format('Y-m-d'),
            'status' => $this->statusLabel(),
            'estimated_cost' => $this->estimated_cost !== null ? number_format($this->estimated_cost, 2, '.', '') : null,
        ];
    }
}
