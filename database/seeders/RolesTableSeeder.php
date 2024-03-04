<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Roles::create(['public_id' => Str::random(10), 'label' => 'Admin']);
        Roles::create(['public_id' => Str::random(10), 'label' => 'Lambda']);
    }
}
