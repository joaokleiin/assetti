<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\Sector;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentFactory extends Factory
{
    protected $model = Equipment::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' ' . $this->faker->word(),
            'asset_number' => $this->faker->unique()->numerify('AT-######'),
            'serial_number' => $this->faker->unique()->sha1(),
            'description' => $this->faker->sentence(),
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
            'sector_id' => Sector::factory(),
            'status' => $this->faker->randomElement([
                Equipment::STATUS_AVAILABLE,
                Equipment::STATUS_IN_USE,
                Equipment::STATUS_MAINTENANCE,
                Equipment::STATUS_RESERVED,
                Equipment::STATUS_RETIRED,
            ]),
            'acquisition_date' => $this->faker->dateTimeBetween('-2 years'),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
