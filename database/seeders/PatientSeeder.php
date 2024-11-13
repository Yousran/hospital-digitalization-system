<?php

namespace Database\Seeders;

use App\Models\Biograph;
use App\Models\Patient;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        Patient::create([
            'user_id' => 1,
            'biograph_id' => 1,
            'relatives' => null,
        ]);
        Patient::create([
            'user_id' => 2,
            'biograph_id' => 2,
            'relatives' => 1,
        ]);
        Patient::create([
            'user_id' => null,
            'biograph_id' => 3,
            'relatives' => 1,
        ]);


    }
}
