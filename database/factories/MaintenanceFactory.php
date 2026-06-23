<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Maintenance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaintenanceFactory extends Factory
{
    protected $model = Maintenance::class;

    public function definition(): array
    {
        return [
            'equipment_id' => Equipment::factory(),
            'user_id' => User::factory(),
            'maintenance_type' => $this->faker->word(),
            'problem_description' => $this->faker->sentence(),
            'solution_description' => $this->faker->optional()->sentence(),
            'maintenance_date' => $this->faker->dateTimeBetween('-1 year'),
            'estimated_cost' => $this->faker->optional()->randomFloat(2, 100, 5000),
            'status' => $this->faker->randomElement([
                Maintenance::STATUS_OPEN,
                Maintenance::STATUS_IN_PROGRESS,
                Maintenance::STATUS_COMPLETED,
                Maintenance::STATUS_CANCELED,
            ]),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
