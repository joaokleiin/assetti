<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\Maintenance;
use App\Models\Sector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_returns_counts(): void
    {
        Category::factory()->count(2)->create();
        Brand::factory()->count(2)->create();
        Sector::factory()->count(2)->create();
        Equipment::factory()->count(3)->create();
        Maintenance::factory()->count(4)->create();
        Maintenance::factory()->create(['status' => Maintenance::STATUS_OPEN]);
        Maintenance::factory()->create(['status' => Maintenance::STATUS_COMPLETED]);

        $response = $this->getJson('/api/dashboard');

        $response->assertOk()
            ->assertJsonStructure([
                'total_equipments',
                'total_categories',
                'total_brands',
                'total_sectors',
                'total_maintenances',
                'open_maintenances',
                'completed_maintenances',
            ])
            ->assertJson([
                'total_equipments' => 3,
                'total_categories' => 2,
                'total_brands' => 2,
                'total_sectors' => 2,
                'total_maintenances' => 6,
                'open_maintenances' => 1,
                'completed_maintenances' => 1,
            ]);
    }
}
