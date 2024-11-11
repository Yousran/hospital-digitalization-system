<?php

namespace Database\Seeders;

use App\Models\Biograph;
use App\Models\Doctor;
use App\Models\Speciality;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doctor::create([
            'user_id' => 1,
            'speciality_id' => 1,
            'rating' => 0,
        ]);
    }
}
