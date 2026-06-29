<?php

namespace Database\Seeders;

use App\Models\GolfCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            // SqlFileSeeder::class,
        ]);

        GolfCourse::factory()->count(5000)->create();
    }
}
