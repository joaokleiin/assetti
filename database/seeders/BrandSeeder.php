<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Dell', 'Lenovo', 'HP', 'Samsung', 'Epson', 'LG', 'Intelbras'] as $name) {
            Brand::updateOrCreate(['name' => $name]);
        }
    }
}
