<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserLevel;
use Database\Factories\UserFactory;
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

        // Create default users with specific roles
        UserLevel::factory()->create([
            'name_user_level' => 'Rektor'
        ]);
        UserLevel::factory()->create([
            'name_user_level' => 'Admin'
        ]);
        UserLevel::factory()->create([
            'name_user_level' => 'Petugas'
        ]);
        UserLevel::factory()->create([
            'name_user_level' => 'Publik'
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'user_level_id' => 1
        ]);
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'user_level_id' => 2
        ]);
        User::factory()->create([
            'name' => 'petugas',
            'email' => 'petugas123@gmail.com',
            'password' => bcrypt('password'),
            'user_level_id' => 3
        ]);
        User::factory()->create([
            'name' => 'publik',
            'email' => 'publik@gmail.com',
            'password' => bcrypt('password'),
            'user_level_id' => 4
        ]);
        

        PublicInformationRequest::factory(10)->create();
        Objection::factory(10)->create();
        Whistle::factory(10)->create();
        Galleries::factory(10)->create();
    }
}
