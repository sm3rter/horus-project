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
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Test User 1',
            'email' => 'test@test.com',
            'password' => bcrypt('test'),
            'role' => 'user',
        ]);

        $this->call([
            CourseSeeder::class,
        ]);
    }
}
