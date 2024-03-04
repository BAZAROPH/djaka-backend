<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Roles;
use App\Models\Towns;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Entities;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Roles::create(['public_id' => Str::random(10), 'label' => 'Admin']);
        Roles::create(['public_id' => Str::random(10), 'label' => 'Lambda']);

        Cities::create(['public_id' => Str::random(10), 'name' => 'Abidjan']);
        Cities::create(['public_id' => Str::random(10), 'name' => 'Yamoussokro']);
        Cities::create(['public_id' => Str::random(10), 'name' => 'Bouaké']);
        Cities::create(['public_id' => Str::random(10), 'name' => 'Korogho']);

        Countries::create(['public_id' => Str::random(10), 'name' => 'Côte d\'Ivoire']);
        Countries::create(['public_id' => Str::random(10), 'name' => 'Mali']);
        Countries::create(['public_id' => Str::random(10), 'name' => 'Burkina Faso']);

        Towns::create(['public_id' => Str::random(10), 'name' => 'Cocody']);
        Towns::create(['public_id' => Str::random(10), 'name' => 'Adjamé']);
        Towns::create(['public_id' => Str::random(10), 'name' => 'Yopougon']);

    }
}
