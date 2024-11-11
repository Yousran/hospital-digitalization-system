<?php

namespace Database\Seeders;

use App\Models\Speciality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Speciality::create([
            'name' => 'Neurologi',
            'description' => 'Spesialisasi dalam perawatan dan pengobatan sistem saraf pusat dan perifer.',
        ]);
        
        Speciality::create([
            'name' => 'Kedokteran Gigi',
            'description' => 'Spesialisasi yang fokus pada kesehatan gigi, gusi, dan mulut.',
        ]);
        
        Speciality::create([
            'name' => 'Andrologi',
            'description' => 'Spesialisasi dalam kesehatan sistem reproduksi pria.',
        ]);
        
        Speciality::create([
            'name' => 'Dermatologi',
            'description' => 'Spesialisasi yang menangani masalah kesehatan kulit, rambut, dan kuku.',
        ]);
        
        Speciality::create([
            'name' => 'Orthopedi',
            'description' => 'Spesialisasi yang berfokus pada kesehatan tulang, sendi, dan sistem gerak.',
        ]);
        
        Speciality::create([
            'name' => 'Oftalmologi',
            'description' => 'Spesialisasi dalam perawatan kesehatan mata dan gangguan penglihatan.',
        ]);
    }
}
