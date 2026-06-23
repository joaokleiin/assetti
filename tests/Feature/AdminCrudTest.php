<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_routes_require_authentication(): void
    {
        $this->get(route('categories.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_manage_categories(): void
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('categories.store'), [
            'name' => 'Perifericos',
            'description' => 'Acessorios de TI.',
        ])
            ->assertRedirect(route('categories.index'))
            ->assertSessionHas('success');

        $category = Category::query()->where('name', 'Perifericos')->firstOrFail();

        $this->put(route('categories.update', $category), [
            'name' => 'Perifericos corporativos',
            'description' => 'Acessorios utilizados pela equipe.',
        ])
            ->assertRedirect(route('categories.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('categories', [
            'name' => 'Perifericos corporativos',
        ]);

        $this->delete(route('categories.destroy', $category))
            ->assertRedirect(route('categories.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }

    public function test_authenticated_user_can_manage_brands(): void
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('brands.store'), [
            'name' => 'Acer',
        ])
            ->assertRedirect(route('brands.index'))
            ->assertSessionHas('success');

        $brand = Brand::query()->where('name', 'Acer')->firstOrFail();

        $this->put(route('brands.update', $brand), [
            'name' => 'Acer Brasil',
        ])
            ->assertRedirect(route('brands.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('brands', [
            'name' => 'Acer Brasil',
        ]);

        $this->delete(route('brands.destroy', $brand))
            ->assertRedirect(route('brands.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('brands', [
            'id' => $brand->id,
        ]);
    }

    public function test_authenticated_user_can_manage_sectors(): void
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('sectors.store'), [
            'name' => 'Compras',
            'responsible' => 'Joao Silva',
            'location' => 'Sala 12',
        ])
            ->assertRedirect(route('sectors.index'))
            ->assertSessionHas('success');

        $sector = Sector::query()->where('name', 'Compras')->firstOrFail();

        $this->put(route('sectors.update', $sector), [
            'name' => 'Suprimentos',
            'responsible' => 'Joao Silva',
            'location' => 'Sala 14',
        ])
            ->assertRedirect(route('sectors.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('sectors', [
            'name' => 'Suprimentos',
            'location' => 'Sala 14',
        ]);

        $this->delete(route('sectors.destroy', $sector))
            ->assertRedirect(route('sectors.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('sectors', [
            'id' => $sector->id,
        ]);
    }

    public function test_equipment_relationships_are_configured(): void
    {
        $category = Category::create([
            'name' => 'Notebooks',
            'description' => 'Equipamentos portateis.',
        ]);
        $brand = Brand::create(['name' => 'Dell']);
        $sector = Sector::create([
            'name' => 'TI',
            'responsible' => 'Ana Souza',
            'location' => 'Bloco A',
        ]);

        $equipment = Equipment::create([
            'name' => 'Notebook Latitude',
            'asset_number' => 'PAT-0001',
            'serial_number' => 'SN-0001',
            'description' => 'Notebook para testes.',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'sector_id' => $sector->id,
            'status' => Equipment::STATUS_AVAILABLE,
            'acquisition_date' => '2026-01-15',
            'notes' => 'Carga inicial.',
        ]);

        $this->assertTrue($equipment->category->is($category));
        $this->assertTrue($equipment->brand->is($brand));
        $this->assertTrue($equipment->sector->is($sector));
        $this->assertTrue($category->equipments->contains($equipment));
        $this->assertTrue($brand->equipments->contains($equipment));
        $this->assertTrue($sector->equipments->contains($equipment));
    }
}
