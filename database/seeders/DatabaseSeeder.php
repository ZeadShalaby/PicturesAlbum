<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Album;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //// todo add one customer ////
        $defUsers = User::factory()->create([  
            'firstname' => 'user',
            'lastname' => 'album',
            'email' => 'user@user.com',
            'password' => Hash::make('user'),
        ]);

        // todo create users with gender male
        $users = User::factory()
        ->male()
        ->count(9)
        ->create();
        $users->push($defUsers);

        // todo create users with gender female
        $users = User::factory()
        ->female()
        ->count(10)
        ->create();

        //// todo add albums ////
        $albums = Album::factory()->count(10)->create();

        //// todo add albums ////
        $albums = Image::factory()->count(30)->create();
    }
}
