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

class PublicAreaTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_home_page_displays_statistics_and_recent_items(): void
    {
        $user = User::factory()->create();

        [$category, $brand, $sector] = $this->createRelations();

        $equipment = Equipment::create([
            'name' => 'Notebook Publico',
            'asset_number' => 'PAT-100-PUB',
            'serial_number' => 'SN-PUB-100',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'sector_id' => $sector->id,
            'status' => Equipment::STATUS_AVAILABLE,
        ]);

        Maintenance::create([
            'equipment_id' => $equipment->id,
            'user_id' => $user->id,
            'maintenance_type' => 'Preventiva',
            'problem_description' => 'Teste de manutenção pública.',
            'maintenance_date' => now(),
            'status' => Maintenance::STATUS_OPEN,
        ]);

        $response = $this->get(route('public.home'));

        $response->assertOk();
        $response->assertSee('Total de Equipamentos');
        $response->assertSee('Total de Categorias');
        $response->assertSee('Total de Setores');
        $response->assertSee('Total de Manutenções');
        $response->assertSee('Notebook Publico');
        $response->assertSee('Preventiva');
    }

    public function test_public_catalog_search_and_filters_work(): void
    {
        [$category, $brand, $sector] = $this->createRelations();
        $otherCategory = Category::create(['name' => 'Monitores']);
        $otherBrand = Brand::create(['name' => 'HP']);
        $otherSector = Sector::create(["name" => 'Financeiro', 'responsible' => 'Rafael', 'location' => 'Bloco B']);

        Equipment::create([
            'name' => 'Servidor Alpha',
            'asset_number' => 'SRV-ALPHA',
            'serial_number' => 'SN-ALPHA',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'sector_id' => $sector->id,
            'status' => Equipment::STATUS_IN_USE,
        ]);

        Equipment::create([
            'name' => 'Monitor Beta',
            'asset_number' => 'MON-BETA',
            'serial_number' => 'SN-BETA',
            'category_id' => $otherCategory->id,
            'brand_id' => $otherBrand->id,
            'sector_id' => $otherSector->id,
            'status' => Equipment::STATUS_RESERVED,
        ]);

        $response = $this->get(route('public.equipments.index', [
            'search' => 'Alpha',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'sector_id' => $sector->id,
            'status' => Equipment::STATUS_IN_USE,
        ]));

        $response->assertOk();
        $response->assertSee('Servidor Alpha');
        $response->assertDontSee('Monitor Beta');
    }

    public function test_public_equipment_details_show_history_and_navigation(): void
    {
        $user = User::factory()->create();
        [$category, $brand, $sector] = $this->createRelations();

        $equipment = Equipment::create([
            'name' => 'Desktop Demo',
            'asset_number' => 'DESK-001',
            'serial_number' => 'SN-001',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'sector_id' => $sector->id,
            'status' => Equipment::STATUS_MAINTENANCE,
        ]);

        Maintenance::create([
            'equipment_id' => $equipment->id,
            'user_id' => $user->id,
            'maintenance_type' => 'Corretiva',
            'problem_description' => 'Tela com falha.',
            'maintenance_date' => now(),
            'status' => Maintenance::STATUS_IN_PROGRESS,
        ]);

        $response = $this->get(route('public.equipments.show', $equipment));

        $response->assertOk();
        $response->assertSee('Desktop Demo');
        $response->assertSee('Patrimônio DESK-001');
        $response->assertSee('Corretiva');
        $response->assertSee('Em andamento');
        $response->assertSee('Voltar para catálogo');
    }

    /**
     * @return array{0: Category, 1: Brand, 2: Sector}
     */
    private function createRelations(): array
    {
        return [
            Category::create(['name' => 'Notebooks', 'description' => 'Equipamentos portáteis.']),
            Brand::create(['name' => 'Dell']),
            Sector::create(['name' => 'Tecnologia da Informação', 'responsible' => 'Ana Souza', 'location' => 'Bloco A']),
        ];
    }
}
