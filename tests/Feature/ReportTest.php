<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\Maintenance;
use App\Models\Sector;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_unauthenticated_user_cannot_access_reports(): void
    {
        $this->get(route('reports.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_access_reports_page(): void
    {
        $this->actingAs($this->user)
            ->get(route('reports.index'))
            ->assertOk()
            ->assertViewIs('reports.index');
    }

    public function test_reports_page_contains_filters(): void
    {
        $this->actingAs($this->user)
            ->get(route('reports.index'))
            ->assertOk()
            ->assertViewHas(['categories', 'sectors', 'equipmentStatuses', 'maintenanceStatuses']);
    }

    public function test_filter_equipments_by_category(): void
    {
        $category = Category::factory()->create(['name' => 'Computadores']);
        $equipment = Equipment::factory()->create(['category_id' => $category->id]);

        $this->actingAs($this->user)
            ->get(route('reports.index', ['category_id' => $category->id]))
            ->assertOk()
            ->assertViewHas('equipments', function ($equipments) use ($equipment) {
                return $equipments->contains($equipment);
            });
    }

    public function test_filter_equipments_by_sector(): void
    {
        $sector = Sector::factory()->create(['name' => 'TI']);
        $equipment = Equipment::factory()->create(['sector_id' => $sector->id]);

        $this->actingAs($this->user)
            ->get(route('reports.index', ['sector_id' => $sector->id]))
            ->assertOk()
            ->assertViewHas('equipments', function ($equipments) use ($equipment) {
                return $equipments->contains($equipment);
            });
    }

    public function test_filter_equipments_by_status(): void
    {
        $equipment = Equipment::factory()->create(['status' => Equipment::STATUS_IN_USE]);

        $this->actingAs($this->user)
            ->get(route('reports.index', ['equipment_status' => Equipment::STATUS_IN_USE]))
            ->assertOk()
            ->assertViewHas('equipments', function ($equipments) use ($equipment) {
                return $equipments->contains($equipment);
            });
    }

    public function test_filter_maintenances_by_status(): void
    {
        $maintenance = Maintenance::factory()->create(['status' => Maintenance::STATUS_COMPLETED]);

        $this->actingAs($this->user)
            ->get(route('reports.index', ['maintenance_status' => Maintenance::STATUS_COMPLETED]))
            ->assertOk()
            ->assertViewHas('maintenances', function ($maintenances) use ($maintenance) {
                return $maintenances->contains($maintenance);
            });
    }

    public function test_filter_maintenances_by_date_range(): void
    {
        $dateFrom = Carbon::now()->subDays(10)->format('Y-m-d');
        $dateTo = Carbon::now()->format('Y-m-d');

        $maintenance = Maintenance::factory()->create([
            'maintenance_date' => Carbon::now()->subDays(5),
        ]);

        $this->actingAs($this->user)
            ->get(route('reports.index', [
                'date_from' => $dateFrom,
                'date_to' => $dateTo,
            ]))
            ->assertOk()
            ->assertViewHas('maintenances', function ($maintenances) use ($maintenance) {
                return $maintenances->contains($maintenance);
            });
    }

    public function test_summary_cards_display_correct_totals(): void
    {
        Equipment::factory(5)->create(['status' => Equipment::STATUS_IN_USE]);
        Equipment::factory(3)->create(['status' => Equipment::STATUS_MAINTENANCE]);
        Maintenance::factory(7)->create();

        $this->actingAs($this->user)
            ->get(route('reports.index'))
            ->assertOk()
            ->assertViewHas('summary');
    }

    public function test_export_pdf_requires_authentication(): void
    {
        $this->get(route('reports.export.pdf'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_export_pdf(): void
    {
        Equipment::factory(3)->create();
        Maintenance::factory(2)->create();

        $response = $this->actingAs($this->user)
            ->get(route('reports.export.pdf'));

        $response->assertOk();
    }

    public function test_authenticated_user_can_export_pdf_with_filters(): void
    {
        $category = Category::factory()->create();
        Equipment::factory(5)->create(['category_id' => $category->id]);

        $response = $this->actingAs($this->user)
            ->get(route('reports.export.pdf', ['category_id' => $category->id]));

        $response->assertOk();
    }

    public function test_export_csv_requires_authentication(): void
    {
        $this->get(route('reports.export.csv'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_export_csv(): void
    {
        Equipment::factory(3)->create();
        Maintenance::factory(2)->create();

        $response = $this->actingAs($this->user)
            ->get(route('reports.export.csv'));

        $response->assertOk();
        $response->assertHeader('content-type', 'text/csv; charset=utf-8');
    }

    public function test_authenticated_user_can_export_csv_with_filters(): void
    {
        $sector = Sector::factory()->create();
        Equipment::factory(5)->create(['sector_id' => $sector->id]);

        $response = $this->actingAs($this->user)
            ->get(route('reports.export.csv', ['sector_id' => $sector->id]));

        $response->assertOk();
        $response->assertHeader('content-type', 'text/csv; charset=utf-8');
    }

    public function test_invalid_filter_values_are_rejected(): void
    {
        $this->actingAs($this->user)
            ->get(route('reports.index', [
                'category_id' => 9999,
                'equipment_status' => 'invalid_status',
            ]))
            ->assertRedirect();
    }

    public function test_date_from_must_be_before_date_to(): void
    {
        $dateFrom = Carbon::now()->format('Y-m-d');
        $dateTo = Carbon::now()->subDays(5)->format('Y-m-d');

        $this->actingAs($this->user)
            ->get(route('reports.index', [
                'date_from' => $dateFrom,
                'date_to' => $dateTo,
            ]))
            ->assertRedirect();
    }

    public function test_empty_results_show_appropriate_message(): void
    {
        $this->actingAs($this->user)
            ->get(route('reports.index', ['category_id' => 9999]))
            ->assertOk()
            ->assertViewHas('equipments', function ($equipments) {
                return $equipments->isEmpty();
            });
    }

    public function test_multiple_filters_work_together(): void
    {
        $category = Category::factory()->create();
        $sector = Sector::factory()->create();

        $equipment = Equipment::factory()->create([
            'category_id' => $category->id,
            'sector_id' => $sector->id,
            'status' => Equipment::STATUS_IN_USE,
        ]);

        Equipment::factory()->create(['category_id' => $category->id]);

        $this->actingAs($this->user)
            ->get(route('reports.index', [
                'category_id' => $category->id,
                'sector_id' => $sector->id,
                'equipment_status' => Equipment::STATUS_IN_USE,
            ]))
            ->assertOk()
            ->assertViewHas('equipments', function ($equipments) use ($equipment) {
                return $equipments->count() === 1 && $equipments->contains($equipment);
            });
    }
}
