<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medicine::create([
            'name' => 'Paracetamol',
            'description' => 'Digunakan untuk menurunkan demam dan menghilangkan rasa sakit.',
            'type' => 'Tablet',
            'stock' => 150,
            'picture' => null,
        ]);

        Medicine::create([
            'name' => 'Amoxcillin',
            'description' => 'Antibiotik untuk mengobati infeksi bakteri.',
            'type' => 'Kapsul',
            'stock' => 100,
            'picture' => null,
        ]);

        Medicine::create([
            'name' => 'Ibuprofen',
            'description' => 'Obat antiinflamasi untuk nyeri dan demam.',
            'type' => 'Tablet',
            'stock' => 80,
            'picture' => null,
        ]);

        Medicine::create([
            'name' => 'Cetirizine',
            'description' => 'Antihistamin untuk mengurangi gejala alergi.',
            'type' => 'Tablet',
            'stock' => 120,
            'picture' => null,
        ]);

        Medicine::create([
            'name' => 'Omeprazole',
            'description' => 'Mengurangi produksi asam lambung.',
            'type' => 'Kapsul',
            'stock' => 90,
            'picture' => null,
        ]);

        Medicine::create([
            'name' => 'Metformin',
            'description' => 'Mengontrol kadar gula darah pada diabetes.',
            'type' => 'Tablet',
            'stock' => 110,
            'picture' => null,
        ]);

        Medicine::create([
            'name' => 'Aspirin',
            'description' => 'Digunakan untuk mengurangi nyeri, demam, dan inflamasi.',
            'type' => 'Tablet',
            'stock' => 200,
            'picture' => null,
        ]);

        Medicine::create([
            'name' => 'Captopril',
            'description' => 'Obat untuk mengontrol tekanan darah tinggi.',
            'type' => 'Tablet',
            'stock' => 60,
            'picture' => null,
        ]);

        Medicine::create([
            'name' => 'Loperamide',
            'description' => 'Obat untuk mengobati diare akut.',
            'type' => 'Kapsul',
            'stock' => 90,
            'picture' => null,
        ]);

        Medicine::create([
            'name' => 'Salbutamol',
            'description' => 'Obat yang digunakan untuk asma dan masalah pernapasan.',
            'type' => 'Inhaler',
            'stock' => 50,
            'picture' => null,
        ]);
    }
}
