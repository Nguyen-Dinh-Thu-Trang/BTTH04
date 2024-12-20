<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ComputersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            DB::table('computers')->insert([
                'computer_name' => $faker->word() . '-' . $faker->randomNumber(3),
                'model' => $faker->randomElement(['Dell OptiPlex 7090', 'Dell Latitude 5520', 'Dell XPS 13 Plus', 'Dell Precision 5570']),
                'operating_system' => $faker->randomElement(['Windows 10 Pro', 'Windows 11', 'Windows 7', 'Windows 8', 'Windows XP']),
                'processor' => $faker->randomElement(['Intel Core i5-11400', 'AMD Ryzen 5 5600X', 'Intel Core i7-12700K']),
                'memory' => $faker->randomElement([8, 16, 32, 64]),
                'available' => $faker->boolean()
            ]);
        }
    }
}
