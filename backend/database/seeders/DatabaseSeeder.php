<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

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

        User::insert([
            [
                "username" => "admin1",
                "password" => bcrypt("admin1"),
                "no_ktp" => "1234567812345678",
                "name" => "admin1",
                "date_of_birth" => "1990-10-20",
                "email" => "admin1@gmail.com",
                "phone" => "0812345678910",
            ],
            [
                "username" => "user1",
                "password" => bcrypt("user1"),
                "no_ktp" => "1234567812345678",
                "name" => "user1",
                "date_of_birth" => "1990-10-20",
                "email" => "user1@gmail.com",
                "phone" => "0812345678910",
            ],
        ]);
    }
}
