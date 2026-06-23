<?php

namespace Tests\Feature;

use App\Models\Equipment;
use App\Models\Maintenance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiEquipmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_equipments_returns_items_with_relations(): void
    {
        $equipment = Equipment::factory()->create();

        $response = $this->getJson('/api/equipments');

        $response->assertOk()
            ->assertJsonStructure([
                [
                    'id',
                    'name',
                    'asset_number',
                    'serial_number',
                    'status',
                    'category' => ['id', 'name'],
                    'brand' => ['id', 'name'],
                    'sector' => ['id', 'name'],
                ],
            ])
            ->assertJsonFragment([
                'id' => $equipment->id,
                'name' => $equipment->name,
                'asset_number' => $equipment->asset_number,
            ]);
    }

    public function test_show_equipment_returns_equipment_with_maintenances(): void
    {
        $equipment = Equipment::factory()->create();
        Maintenance::factory()->for($equipment)->create();

        $response = $this->getJson('/api/equipments/'.$equipment->id);

        $response->assertOk()
            ->assertJsonStructure([
                'id',
                'name',
                'asset_number',
                'serial_number',
                'status',
                'category' => ['id', 'name'],
                'brand' => ['id', 'name'],
                'sector' => ['id', 'name'],
                'maintenances',
            ]);
    }

    public function test_show_equipment_returns_404_when_not_found(): void
    {
        $this->getJson('/api/equipments/999999')
            ->assertNotFound()
            ->assertExactJson(['message' => 'Registro não encontrado']);
    }
}
