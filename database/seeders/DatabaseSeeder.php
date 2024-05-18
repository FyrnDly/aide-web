<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@aide.com',
            'password' => 'kEl72.24',
            'role' => 'root',
        ]);

        User::factory()->create([
            'name' => 'Fadly Ramdani',
            'email' => 'ramdanifadly@apps.ipb.ac.id',
            'password' => 'kEl72.24',
            'role' => 'admin',
        ]);
    }
}
