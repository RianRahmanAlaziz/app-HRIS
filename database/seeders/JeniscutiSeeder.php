<?php

namespace Database\Seeders;

use App\Models\JenisCuti;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JeniscutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisCuti::create([
            'n_cuti' => 'Sakit'
        ]);

        JenisCuti::create([
            'n_cuti' => 'Mengandung dan Melahirkan'
        ]);
    }
}
