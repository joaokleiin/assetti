<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::whereIn('name', [
            'Notebook',
            'Desktop',
            'Monitor',
            'Impressora',
            'Servidor',
            'Projetor',
            'Switch',
        ])->get();

        $brands = Brand::whereIn('name', [
            'Dell',
            'Lenovo',
            'HP',
            'Samsung',
            'Epson',
            'LG',
            'Intelbras',
        ])->get();

        $sectors = Sector::whereIn('name', [
            'Tecnologia da Informação',
            'Recursos Humanos',
            'Financeiro',
            'Compras',
            'Administração',
            'Jurídico',
        ])->get();

        $names = [
            'Notebook Latitude 5430',
            'Notebook Inspiron 15',
            'Desktop OptiPlex 3090',
            'Desktop ThinkCentre M70s',
            'Monitor UltraSharp 24',
            'Monitor Curvo 27',
            'Impressora EcoTank L3150',
            'Impressora LaserJet Pro M404',
            'Servidor PowerEdge T40',
            'Servidor ThinkSystem ST50',
            'Projetor XGA 3000 Lumens',
            'Projetor LED 1080p',
            'Switch 24 portas Gigabit',
            'Switch 16 portas',
            'Notebook Vostro 3510',
            'Notebook IdeaPad 3',
            'Desktop Pavilion 590',
            'Monitor Odyssey 32',
            'Impressora DeskJet 2700',
            'Impressora EcoTank L3110',
            'Servidor UCS C220',
            'Projetor Business 1024x768',
            'Switch Smart 8 portas',
            'Notebook ProBook 450',
            'Desktop EliteDesk 800',
        ];

        $statuses = [
            Equipment::STATUS_AVAILABLE,
            Equipment::STATUS_IN_USE,
            Equipment::STATUS_MAINTENANCE,
            Equipment::STATUS_RESERVED,
            Equipment::STATUS_RETIRED,
        ];

        foreach (range(1, 25) as $index) {
            $assetNumber = sprintf('PAT-%03d', $index);
            $serialNumber = 'SN' . str_pad((string) $index, 6, '0', STR_PAD_LEFT);
            $name = $names[$index - 1] ?? 'Equipamento ' . $index;

            Equipment::updateOrCreate(
                ['asset_number' => $assetNumber],
                [
                    'name' => $name,
                    'serial_number' => $serialNumber,
                    'description' => 'Equipamento corporativo alocado para uso diário.',
                    'category_id' => $categories->random()->id,
                    'brand_id' => $brands->random()->id,
                    'sector_id' => $sectors->random()->id,
                    'status' => $statuses[array_rand($statuses)],
                    'acquisition_date' => now()->subDays(rand(30, 900))->format('Y-m-d'),
                    'notes' => 'Manutenção em dia e equipamento estável.',
                ]
            );
        }
    }
}
