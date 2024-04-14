<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jabatan::updateOrCreate([
            'n_jabatan' => 'Karyawan'
        ]);

        Jabatan::updateOrCreate([
            'n_jabatan' => 'HRD'
        ]);
    }
}
