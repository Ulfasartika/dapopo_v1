<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Area;
use Database\Factories\AreaFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Super User',
            'username' => 'superuser',
            'password' => Hash::make('rahasia'),
            'role' => 'superuser'
        ]);

       \App\Models\Area::factory(5)->create();
    }
}
