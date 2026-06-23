<?php

namespace Database\Seeders;

use App\Models\Maintenance;
use App\Models\Equipment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@assetti.com'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('password'),
            ]
        );

        $equipments = Equipment::all();

        if ($equipments->isEmpty()) {
            return;
        }

        $types = [
            'Preventiva',
            'Corretiva',
            'Atualização',
            'Troca de peça',
            'Limpeza',
        ];

        $statuses = [
            Maintenance::STATUS_OPEN,
            Maintenance::STATUS_IN_PROGRESS,
            Maintenance::STATUS_COMPLETED,
        ];

        foreach (range(1, 30) as $index) {
            $maintenance = Maintenance::updateOrCreate(
                [
                    'equipment_id' => $equipments->random()->id,
                    'maintenance_date' => now()->subDays(rand(1, 365))->format('Y-m-d'),
                ],
                [
                    'user_id' => $user->id,
                    'maintenance_type' => $types[array_rand($types)],
                    'problem_description' => 'Verificação de funcionamento e análise de performance.',
                    'solution_description' => 'Procedimento concluído conforme manual de manutenção.',
                    'estimated_cost' => rand(120, 2400),
                    'status' => $statuses[array_rand($statuses)],
                    'notes' => 'Relatório registrado no sistema e pendente de aprovação.',
                ]
            );

            if ($maintenance->status === Maintenance::STATUS_COMPLETED) {
                $maintenance->solution_description = 'Manutenção concluída com sucesso e testada.';
                $maintenance->save();
            }
        }
    }
}
