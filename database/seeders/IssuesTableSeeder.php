<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class IssuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $computerIds = DB::table('computers')->pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            DB::table('issues')->insert([
                'computer_id' => $faker->randomElement($computerIds),
                'reported_by' => $faker-> name,
                'reported_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'description' => $faker->paragraph(),
                'urgency' => $faker->randomElement(['Low', 'Medium', 'High']),
                'status' => $faker->randomElement(['Open', 'In Progress', 'Resolved'])
            ]);
        }
    }
}