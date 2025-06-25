<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('messages')->insert([
            [
                'sender_id' => 1,
                'receiver_id' => 2,
                'content_message' => $faker->text(),
                'created_at' => now(),
                'updated_at' => now()
            ],
              [
                'sender_id' => 1,
                'receiver_id' => 3,
                'content_message' => $faker->text(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
