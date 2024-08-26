<?php

namespace Database\Seeders;

use App\Models\Listing;
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
        $user = User::factory()->create([
            'name'=> 'Aung',
            'email'=> 'aung@gmail.com',
        ]);

        Listing::factory(6)->create([
            'user_id'=> $user->id
        ]);

        // Listing::create([
        //     'title' => 'Aung',
        //     'tags'=> 'hello',
        //     'company' => 'amazon',
        //     'location'=> 'yangon',
        //     'email'=> 'aung@gmail.com',
        //     'website'=> 'aung.com',
        //     'description'=> 'aung company is the world greatest one!',
        // ]);

        // Listing::create([
        //     'title' => 'Min',
        //     'tags'=> 'hi',
        //     'company' => 'google',
        //     'location'=> 'mandalay',
        //     'email'=> 'min@gmail.com',
        //     'website'=> 'min.com',
        //     'description'=> 'min company is the world greatest one!',
        // ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
