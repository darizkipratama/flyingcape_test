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
        \App\Models\User::factory(5)->create();
        \App\Models\Product::factory(20)->create();

        \App\Models\User::factory()->create([
            'name' => 'SuperBuyer',
            'email' => 'superbuyer@example.com',
            'phone_number' => '0818555555'
        ]);
    }
}
