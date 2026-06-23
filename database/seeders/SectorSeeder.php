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
            ['name' => 'Recursos Humanos', 'responsible' => 'Carla Mendes', 'location' => 'Bloco B'],
            ['name' => 'Financeiro', 'responsible' => 'Bruno Costa', 'location' => 'Bloco C'],
            ['name' => 'Compras', 'responsible' => 'Mariana Guerra', 'location' => 'Bloco D'],
            ['name' => 'Administração', 'responsible' => 'Patrícia Santos', 'location' => 'Bloco E'],
            ['name' => 'Jurídico', 'responsible' => 'Ricardo Alves', 'location' => 'Bloco F'],
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
