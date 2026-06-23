<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectors = [
            ['name' => 'Tecnologia da Informação', 'responsible' => 'Ana Souza', 'location' => 'Bloco A'],
            ['name' => 'Financeiro', 'responsible' => 'Carlos Lima', 'location' => 'Bloco B'],
            ['name' => 'Recursos Humanos', 'responsible' => 'Mariana Alves', 'location' => 'Bloco C'],
            ['name' => 'Operações', 'responsible' => 'Rafael Martins', 'location' => 'Bloco D'],
        ];

        foreach ($sectors as $sector) {
            Sector::updateOrCreate(
                ['name' => $sector['name']],
                [
                    'responsible' => $sector['responsible'],
                    'location' => $sector['location'],
                ]
            );
        }
    }
}
