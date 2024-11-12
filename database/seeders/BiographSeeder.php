<?php

namespace Database\Seeders;

use App\Models\Biograph;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiographSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Biograph::create([
            'user_id' => 1,
            'nik' => '7602010203040001',
            'surename' => 'am yusran mazidan',
            'date_of_birth' => '2004-03-02',
            'gender' => 'laki-laki',
            'address' => 'jl. martadinata',
            'religion' => 'islam',
            'marriage_status' => 'belum menikah',
            'job' => 'mahasiswa',
            'file_id' => null,
        ]);

        Biograph::create([
            'user_id' => 2,
            'nik' => '7602010203040002',
            'surename' => 'pasien kosong',
            'date_of_birth' => '2004-03-03',
            'gender' => 'laki-laki',
            'address' => 'jl. petta',
            'religion' => 'islam',
            'marriage_status' => 'belum menikah',
            'job' => 'mahasiswa',
            'file_id' => null,
        ]);
    }
}
