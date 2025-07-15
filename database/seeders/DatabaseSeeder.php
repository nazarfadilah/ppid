<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PublicInformationRequest;
use App\Models\Objection;
use App\Models\Whistle;
use App\Models\Galleries;
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
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 1
        ]);
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 2
        ]);
        User::factory()->create([
            'name' => 'petugas',
            'email' => 'petugas123@gmail.com',
            'password' => bcrypt('password'),
            'role' => 3
        ]);
        

        PublicInformationRequest::factory(10)->create();
        Objection::factory(10)->create();
        Whistle::factory(10)->create();
        Galleries::factory(10)->create();
    }
}
