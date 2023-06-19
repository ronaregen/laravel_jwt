<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Hobby;
use App\Models\User;
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
        User::create(
            [
                'nama' => 'regen',
                'email' => 'ronaregen@gmail.com',
                'phone' => 6289514492642,
                'password' => bcrypt('password')
            ]
        );

        Hobby::create([
            'user_id' => 1,
            'hobby' => 'programming'
        ]);

        Hobby::create([
            'user_id' => 1,
            'hobby' => 'reading'
        ]);
    }
}
