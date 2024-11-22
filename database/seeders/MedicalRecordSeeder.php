<?php

namespace Database\Seeders;

use App\Models\MedicalRecord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedicalRecord::create([
            'patient_id' => 1,
            'doctor_id' => 1,
            'diagnosis' => 'Keracunan makanan',
            'action' => 'Rawat Jalan',
        ]);
        MedicalRecord::create([
            'patient_id' => 2,
            'doctor_id' => 2,
            'diagnosis' => 'Migrain',
            'action' => 'Rawat Jalan',
        ]);
        MedicalRecord::create([
            'patient_id' => 2,
            'doctor_id' => 1,
            'diagnosis' => 'Diare',
            'action' => 'Rawat Jalan',
        ]);
    }
}
