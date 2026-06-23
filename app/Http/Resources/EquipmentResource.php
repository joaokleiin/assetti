<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'asset_number' => $this->asset_number,
            'serial_number' => $this->serial_number,
            'status' => $this->statusLabel(),
            'category' => $this->category ? [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ] : null,
            'brand' => $this->brand ? [
                'id' => $this->brand->id,
                'name' => $this->brand->name,
            ] : null,
            'sector' => $this->sector ? [
                'id' => $this->sector->id,
                'name' => $this->sector->name,
            ] : null,
            'maintenances' => $this->whenLoaded('maintenances', MaintenanceResource::collection($this->maintenances)),
        ];
    }
}
