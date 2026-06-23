<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\Maintenance;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaintenanceCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_maintenance_routes_require_authentication(): void
    {
        $this->get(route('maintenances.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_manage_maintenances(): void
    {
        $user = User::factory()->create(['name' => 'Tecnico Teste']);
        $this->actingAs($user);

        $equipment = $this->createEquipment();

        $this->post(route('maintenances.store'), [
            'equipment_id' => $equipment->id,
            'maintenance_type' => 'Preventiva',
            'problem_description' => 'Limpeza interna e verificacao de desempenho.',
            'solution_description' => 'Limpeza concluida e testes realizados.',
            'maintenance_date' => '2026-05-20',
            'estimated_cost' => '150.50',
            'status' => Maintenance::STATUS_OPEN,
            'notes' => 'Agendar nova revisao em seis meses.',
        ])
            ->assertRedirect()
            ->assertSessionHas('success');

        $maintenance = Maintenance::query()->where('maintenance_type', 'Preventiva')->firstOrFail();

        $this->assertTrue($maintenance->user->is($user));
        $this->assertTrue($maintenance->equipment->is($equipment));
        $this->assertDatabaseHas('maintenances', [
            'id' => $maintenance->id,
            'user_id' => $user->id,
            'equipment_id' => $equipment->id,
            'status' => Maintenance::STATUS_OPEN,
        ]);

        $this->get(route('maintenances.show', $maintenance))
            ->assertOk()
            ->assertSee('Preventiva')
            ->assertSee('Aberta')
            ->assertSee('Tecnico Teste');

        $this->put(route('maintenances.update', $maintenance), [
            'equipment_id' => $equipment->id,
            'maintenance_type' => 'Preventiva concluida',
            'problem_description' => 'Limpeza interna e verificacao de desempenho.',
            'solution_description' => 'Servico finalizado.',
            'maintenance_date' => '2026-05-21',
            'estimated_cost' => '175.00',
            'status' => Maintenance::STATUS_COMPLETED,
            'notes' => 'Sem pendencias.',
        ])
            ->assertRedirect(route('maintenances.show', $maintenance))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('maintenances', [
            'id' => $maintenance->id,
            'maintenance_type' => 'Preventiva concluida',
            'status' => Maintenance::STATUS_COMPLETED,
        ]);

        $this->delete(route('maintenances.destroy', $maintenance))
            ->assertRedirect(route('maintenances.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('maintenances', [
            'id' => $maintenance->id,
        ]);
    }

    public function test_maintenance_listing_can_be_filtered_by_query_string(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $notebook = $this->createEquipment('Notebook Alpha', 'PAT-MAN-001');
        $monitor = $this->createEquipment('Monitor Beta', 'PAT-MAN-002');

        Maintenance::create([
            'equipment_id' => $notebook->id,
            'user_id' => $user->id,
            'maintenance_type' => 'Corretiva',
            'problem_description' => 'Tela apresenta falha intermitente.',
            'maintenance_date' => '2026-05-10',
            'estimated_cost' => '300.00',
            'status' => Maintenance::STATUS_IN_PROGRESS,
        ]);

        Maintenance::create([
            'equipment_id' => $monitor->id,
            'user_id' => $user->id,
            'maintenance_type' => 'Preventiva',
            'problem_description' => 'Limpeza preventiva anual.',
            'maintenance_date' => '2026-04-10',
            'status' => Maintenance::STATUS_COMPLETED,
        ]);

        $this->get(route('maintenances.index', [
            'search' => 'falha',
            'equipment_id' => $notebook->id,
            'status' => Maintenance::STATUS_IN_PROGRESS,
            'date_from' => '2026-05-01',
            'date_to' => '2026-05-31',
        ]))
            ->assertOk()
            ->assertSee('Notebook Alpha')
            ->assertSee('Corretiva')
            ->assertSee('Em andamento')
            ->assertDontSeeText('Limpeza preventiva anual.');
    }

    public function test_equipment_detail_displays_maintenance_history(): void
    {
        $user = User::factory()->create(['name' => 'Responsavel TI']);
        $this->actingAs($user);

        $equipment = $this->createEquipment();

        Maintenance::create([
            'equipment_id' => $equipment->id,
            'user_id' => $user->id,
            'maintenance_type' => 'Troca de fonte',
            'problem_description' => 'Fonte apresentou falha.',
            'maintenance_date' => '2026-05-18',
            'status' => Maintenance::STATUS_COMPLETED,
        ]);

        $this->get(route('equipments.show', $equipment))
            ->assertOk()
            ->assertSee('Histórico de manutenções')
            ->assertSee('Troca de fonte')
            ->assertSee('Concluída')
            ->assertSee('Responsavel TI');
    }

    public function test_estimated_cost_must_be_valid(): void
    {
        $this->actingAs(User::factory()->create());

        $equipment = $this->createEquipment();

        $this->post(route('maintenances.store'), [
            'equipment_id' => $equipment->id,
            'maintenance_type' => 'Corretiva',
            'problem_description' => 'Teste de validacao.',
            'maintenance_date' => '2026-05-20',
            'estimated_cost' => '-10',
            'status' => Maintenance::STATUS_OPEN,
        ])
            ->assertSessionHasErrors('estimated_cost');
    }

    private function createEquipment(string $name = 'Notebook TI', string $assetNumber = 'PAT-MAN-000'): Equipment
    {
        $category = Category::create([
            'name' => 'Notebooks '.$assetNumber,
            'description' => 'Equipamentos portateis.',
        ]);
        $brand = Brand::create(['name' => 'Dell '.$assetNumber]);
        $sector = Sector::create([
            'name' => 'Tecnologia da Informacao '.$assetNumber,
            'responsible' => 'Ana Souza',
            'location' => 'Bloco A',
        ]);

        return Equipment::create([
            'name' => $name,
            'asset_number' => $assetNumber,
            'serial_number' => 'SN-'.$assetNumber,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'sector_id' => $sector->id,
            'status' => Equipment::STATUS_IN_USE,
        ]);
    }
}
