<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            SectorSeeder::class,
        ]);

        User::firstOrCreate(['email' => 'admin@assetti.local'], [
            'name' => 'Admin AssetTI',
            'password' => Hash::make('password'),
        ]);
    }
}
