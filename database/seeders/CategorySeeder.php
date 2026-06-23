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
            ['name' => 'Notebook', 'description' => 'Equipamentos portáteis para uso corporativo.'],
            ['name' => 'Desktop', 'description' => 'Estações de trabalho fixas de alto desempenho.'],
            ['name' => 'Monitor', 'description' => 'Monitores e telas de apoio para estações de trabalho.'],
            ['name' => 'Impressora', 'description' => 'Equipamentos de impressão e digitalização.'],
            ['name' => 'Servidor', 'description' => 'Servidores de rede e armazenamento.'],
            ['name' => 'Projetor', 'description' => 'Projetores para apresentações e treinamentos.'],
            ['name' => 'Switch', 'description' => 'Equipamentos de rede para distribuição de conectividade.'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}
