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
            'biograph_id' => 1,
            'speciality_id' => 1,
            'rating' => 0,
        ]);
        Doctor::create([
            'user_id' => null,
            'biograph_id' => 2,
            'speciality_id' => 2,
            'rating' => 0,
        ]);
    }
}
