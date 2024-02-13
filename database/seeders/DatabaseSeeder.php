<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Bluemmb\Faker\PicsumPhotosProvider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $causes = 15;
        $users = 20;

        $faker = Faker::create();
        $faker->addProvider(new PicsumPhotosProvider($faker));

        foreach (range(1, $users) as $user) {
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->freeEmail(),
                'password' => Hash::make('123'),
                'admin' => false
            ]);
        };

        foreach (range(1, $causes) as $cause) {
            DB::table('causes')->insert([
                'title' => $faker->word(),
                'description' => $faker->paragraph(5, true),
                'thumbnail' => $faker->imageUrl(1000, 500, $faker->word()),
                'goal' => rand(1, 250000),
                'user_id' => rand(1, $users),
                'approved' => $faker->boolean(60),
                'created_at' => $faker->dateTime()
            ]);
        };

        foreach (range(1, 12) as $hashtag) {
            DB::table('hashtags')->insert([
                'hashtag' => $faker->word(),
            ]);
        };

        foreach (range(1, 12) as $link) {
            DB::table('cause_hashtag')->insert([
                'cause_id' => rand(1, $causes),
                'hashtag_id' => rand(1, 12),
            ]);
        };

        foreach (range(1, 50) as $link) {
            DB::table('images')->insert([
                'image' => $faker->imageUrl(500, 500, $faker->word()),
                'cause_id' => rand(1, $causes),
            ]);
        };


        DB::table('users')->insert([
            'name' => 'IS1ca7122a5fe82d',
            'email' => '98f87fd651@gmail.com',
            'password' => Hash::make('123'),
            'admin' => true
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'admin' => true
        ]);

        DB::table('users')->insert([
            'name' => 'John',
            'email' => 'john@gmail.com',
            'password' => Hash::make('123'),
            'admin' => false
        ]);
    }
}
