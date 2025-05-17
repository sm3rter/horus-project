<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Level;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Level::insert([
            ['name' => 'level_0'],
            ['name' => 'level_1'],
            ['name' => 'level_2'],
            ['name' => 'level_3'],
            ['name' => 'level_4'],
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        User::create([
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
