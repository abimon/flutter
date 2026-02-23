<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // -- sample call center data (use php artisan db:seed to populate)
        \App\Models\CallAssignment::factory()->count(5)->create();

        // -- sample contributions
        \App\Models\Contribution::factory()->count(3)->create();
    }
}
