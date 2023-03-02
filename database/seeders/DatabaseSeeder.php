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

        \App\Models\User::factory()->create([
            'name' => 'User 1',
            'email' => 'test@example.com',
            'is_admin' => true
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Hisham',
            'email' => 'hishammedhat0@gmail.com',
        ]);
        \App\Models\Listing::factory(30)->create([
            'user_id' => 1
        ]);
        \App\Models\Listing::factory(30)->create([
            'user_id' => 2
        ]);
    }
}
