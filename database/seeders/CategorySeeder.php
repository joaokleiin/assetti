<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Computadores', 'description' => 'Estações de trabalho de uso corporativo.'],
            ['name' => 'Notebooks', 'description' => 'Equipamentos portáteis utilizados por colaboradores.'],
            ['name' => 'Impressoras', 'description' => 'Dispositivos para impressão e digitalização.'],
            ['name' => 'Switches', 'description' => 'Equipamentos de rede para comunicação local.'],
            ['name' => 'Monitores', 'description' => 'Telas e monitores auxiliares.'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}
