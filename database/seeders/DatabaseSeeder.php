<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::insert([
            [
                'id' => Str::uuid(),
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('1234'),
                'role' => 'admin'
            ],
            [
                'id' => Str::uuid(),
                'name' => 'petugas',
                'email' => 'petugas@gmail.com',
                'password' => Hash::make('1234'),
                'role' => 'petugas'
            ]
        ]);
    }
}
