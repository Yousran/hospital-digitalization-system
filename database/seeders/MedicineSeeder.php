<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $files = [
        ['name' => 'paracetamol.png', 'path' => 'placeholder/paracetamol.png', 'alt' => 'Paracetamol Image'],
        ['name' => 'methamphetamine.png', 'path' => 'placeholder/methamphetamine.png', 'alt' => 'Methamphetamine Image'],
        ['name' => 'medical_syringe.png', 'path' => 'placeholder/medical_syringe.png', 'alt' => 'Medical Syringe Image'],
        ['name' => 'panadol.png', 'path' => 'placeholder/panadol.png', 'alt' => 'Panadol Image'],
        ['name' => 'sodium_chlorine.png', 'path' => 'placeholder/sodium_chlorine.png', 'alt' => 'Sodium Chlorine Image'],
        ['name' => 'intravenous_needle.png', 'path' => 'placeholder/intravenous_needle.png', 'alt' => 'Intravenous Needle Image'],
        ['name' => 'aspirin.png', 'path' => 'placeholder/aspirin.png', 'alt' => 'Aspirin Image'],
        ['name' => 'ibuprofen.png', 'path' => 'placeholder/ibuprofen.png', 'alt' => 'Ibuprofen Image'],
        ['name' => 'amoxicillin.png', 'path' => 'placeholder/amoxicillin.png', 'alt' => 'Amoxicillin Image'],
    ];

    foreach ($files as $file) {
        File::create($file);
    }

    Medicine::create([
        'name' => 'Paracetamol',
        'description' => 'Digunakan untuk menurunkan demam dan menghilangkan rasa sakit.',
        'type' => 'Tablet',
        'stock' => 150,
        'picture' => File::where('name', 'paracetamol.png')->first()->id,
    ]);

    Medicine::create([
        'name' => 'Methamphetamine',
        'description' => 'Obat stimulan yang digunakan untuk mengobati ADHD dan narcolepsy.',
        'type' => 'Tablet',
        'stock' => 50,
        'picture' => File::where('name', 'methamphetamine.png')->first()->id,
    ]);

    Medicine::create([
        'name' => 'Medical Syringe',
        'description' => 'Alat suntik medis yang digunakan untuk injeksi.',
        'type' => 'Syringe',
        'stock' => 200,
        'picture' => File::where('name', 'medical_syringe.png')->first()->id,
    ]);

    Medicine::create([
        'name' => 'Panadol',
        'description' => 'Obat untuk mengurangi rasa sakit dan demam.',
        'type' => 'Tablet',
        'stock' => 180,
        'picture' => File::where('name', 'panadol.png')->first()->id,
    ]);

    Medicine::create([
        'name' => 'Sodium Chlorine',
        'description' => 'Larutan garam yang digunakan untuk berbagai keperluan medis.',
        'type' => 'Solution',
        'stock' => 100,
        'picture' => File::where('name', 'sodium_chlorine.png')->first()->id,
    ]);

    Medicine::create([
        'name' => 'Intravenous Needle',
        'description' => 'Jarum yang digunakan untuk infus intravena.',
        'type' => 'Needle',
        'stock' => 300,
        'picture' => File::where('name', 'intravenous_needle.png')->first()->id,
    ]);

    Medicine::create([
        'name' => 'Aspirin',
        'description' => 'Digunakan untuk mengurangi nyeri, demam, dan inflamasi.',
        'type' => 'Tablet',
        'stock' => 200,
        'picture' => File::where('name', 'aspirin.png')->first()->id,
    ]);

    Medicine::create([
        'name' => 'Ibuprofen',
        'description' => 'Obat antiinflamasi untuk nyeri dan demam.',
        'type' => 'Tablet',
        'stock' => 80,
        'picture' => File::where('name', 'ibuprofen.png')->first()->id,
    ]);

    Medicine::create([
        'name' => 'Amoxicillin',
        'description' => 'Antibiotik untuk mengobati infeksi bakteri.',
        'type' => 'Kapsul',
        'stock' => 100,
        'picture' => File::where('name', 'amoxicillin.png')->first()->id,
    ]);
    }
}
