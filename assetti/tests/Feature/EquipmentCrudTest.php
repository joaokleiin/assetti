<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EquipmentCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_equipment_routes_require_authentication(): void
    {
        $this->get(route('equipments.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_manage_equipments(): void
    {
        $this->actingAs(User::factory()->create());

        [$category, $brand, $sector] = $this->createRelations();

        $this->post(route('equipments.store'), [
            'name' => 'Notebook Latitude 5440',
            'asset_number' => 'PAT-1001',
            'serial_number' => 'SN-1001',
            'description' => 'Notebook de uso administrativo.',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'sector_id' => $sector->id,
            'status' => Equipment::STATUS_AVAILABLE,
            'acquisition_date' => '2026-02-10',
            'notes' => 'Equipamento novo.',
        ])
            ->assertRedirect()
            ->assertSessionHas('success');

        $equipment = Equipment::query()->where('asset_number', 'PAT-1001')->firstOrFail();

        $this->get(route('equipments.show', $equipment))
            ->assertOk()
            ->assertSee('Notebook Latitude 5440')
            ->assertSee('Disponível')
            ->assertSee('Tecnologia da Informação');

        $this->put(route('equipments.update', $equipment), [
            'name' => 'Notebook Latitude 5450',
            'asset_number' => 'PAT-1001',
            'serial_number' => 'SN-1001-UPDATED',
            'description' => 'Notebook atualizado.',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'sector_id' => $sector->id,
            'status' => Equipment::STATUS_IN_USE,
            'acquisition_date' => '2026-02-10',
            'notes' => 'Entregue ao setor.',
        ])
            ->assertRedirect(route('equipments.show', $equipment))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('equipments', [
            'id' => $equipment->id,
            'name' => 'Notebook Latitude 5450',
            'status' => Equipment::STATUS_IN_USE,
        ]);

        $this->delete(route('equipments.destroy', $equipment))
            ->assertRedirect(route('equipments.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('equipments', [
            'id' => $equipment->id,
        ]);
    }

    public function test_equipment_listing_can_be_filtered_by_query_string(): void
    {
        $this->actingAs(User::factory()->create());

        [$category, $brand, $sector] = $this->createRelations();
        $otherCategory = Category::create(['name' => 'Monitores']);
        $otherSector = Sector::create(['name' => 'Financeiro']);

        Equipment::create([
            'name' => 'Notebook Alpha',
            'asset_number' => 'PAT-ALPHA',
            'serial_number' => 'SN-ALPHA',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'sector_id' => $sector->id,
            'status' => Equipment::STATUS_AVAILABLE,
        ]);

        Equipment::create([
            'name' => 'Monitor Beta',
            'asset_number' => 'PAT-BETA',
            'serial_number' => 'SN-BETA',
            'category_id' => $otherCategory->id,
            'brand_id' => $brand->id,
            'sector_id' => $otherSector->id,
            'status' => Equipment::STATUS_RESERVED,
        ]);

        $this->get(route('equipments.index', [
            'search' => 'ALPHA',
            'category_id' => $category->id,
            'sector_id' => $sector->id,
            'status' => Equipment::STATUS_AVAILABLE,
        ]))
            ->assertOk()
            ->assertSee('Notebook Alpha')
            ->assertDontSee('Monitor Beta');
    }

    public function test_asset_number_must_be_unique(): void
    {
        $this->actingAs(User::factory()->create());

        [$category, $brand, $sector] = $this->createRelations();

        Equipment::create([
            'name' => 'Notebook Existente',
            'asset_number' => 'PAT-UNICO',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'sector_id' => $sector->id,
            'status' => Equipment::STATUS_AVAILABLE,
        ]);

        $this->post(route('equipments.store'), [
            'name' => 'Notebook Duplicado',
            'asset_number' => 'PAT-UNICO',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'sector_id' => $sector->id,
            'status' => Equipment::STATUS_AVAILABLE,
        ])
            ->assertSessionHasErrors('asset_number');
    }

    /**
     * @return array{0: Category, 1: Brand, 2: Sector}
     */
    private function createRelations(): array
    {
        return [
            Category::create([
                'name' => 'Notebooks',
                'description' => 'Equipamentos portateis.',
            ]),
            Brand::create(['name' => 'Dell']),
            Sector::create([
                'name' => 'Tecnologia da Informação',
                'responsible' => 'Ana Souza',
                'location' => 'Bloco A',
            ]),
        ];
    }
}
