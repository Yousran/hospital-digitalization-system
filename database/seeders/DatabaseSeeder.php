<?php

namespace Database\Seeders;

use App\Models\Biograph;
use App\Models\Doctor;
use App\Models\Speciality;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BiographSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(SpecialitySeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(MedicineSeeder::class);
        $this->call(PatientSeeder::class);
    }
}
