<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Rent;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

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

        $faker = Faker::create('id-ID');

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

        // for ($i = 0; $i <= 10; $i++) {
        //     Rent::create([
        //         "tenant" => $faker->id(),
        //         "no_car" => $faker->randomNumber(),
        //         "date_borrow" => $faker->date(),
        //         "date_return" => $faker->date(),
        //         "down_payment" => $faker->randomFloat(),
        //         "discount" => $faker->randomFloat(),
        //         "total" => $faker->randomFloat(),
        //     ]);
        // };
    }
}
