<?php

namespace Database\Factories;

use App\Models\Sector;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectorFactory extends Factory
{
    protected $model = Sector::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'responsible' => $this->faker->name(),
            'location' => $this->faker->city(),
        ];
    }
}
