<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'IS1ca7122a5fe82d',
            'email' => '98f87fd651@gmail.com',
            'password' => Hash::make('123'),
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
