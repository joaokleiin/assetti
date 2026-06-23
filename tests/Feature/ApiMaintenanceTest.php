<?php

namespace Tests\Feature;

use App\Models\Maintenance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiMaintenanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_maintenances_returns_items_with_equipment(): void
    {
        $maintenance = Maintenance::factory()->create();

        $response = $this->getJson('/api/maintenances');

        $response->assertOk()
            ->assertJsonStructure([
                [
                    'id',
                    'equipment' => ['id', 'name', 'asset_number'],
                    'maintenance_type',
                    'maintenance_date',
                    'status',
                    'estimated_cost',
                ],
            ])
            ->assertJsonFragment([
                'id' => $maintenance->id,
                'maintenance_type' => $maintenance->maintenance_type,
            ]);
    }

    public function test_show_maintenance_returns_item(): void
    {
        $maintenance = Maintenance::factory()->create();

        $response = $this->getJson('/api/maintenances/'.$maintenance->id);

        $response->assertOk()
            ->assertJsonStructure([
                'id',
                'equipment' => ['id', 'name', 'asset_number'],
                'maintenance_type',
                'maintenance_date',
                'status',
                'estimated_cost',
            ])
            ->assertJsonFragment([
                'id' => $maintenance->id,
                'maintenance_type' => $maintenance->maintenance_type,
            ]);
    }

    public function test_show_maintenance_returns_404_when_not_found(): void
    {
        $this->getJson('/api/maintenances/999999')
            ->assertNotFound()
            ->assertExactJson(['message' => 'Registro não encontrado']);
    }
}
