<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'yousranmz',
            'email' => 'yusranmazidan@gmail.com',
            'password' => bcrypt('123456789'),
            'picture' => null,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'patientzero',
            'email' => 'patientzero@gmail.com',
            'password' => bcrypt('123456789'),
            'picture' => null,
            'email_verified_at' => now(),
        ]);
    }
}
