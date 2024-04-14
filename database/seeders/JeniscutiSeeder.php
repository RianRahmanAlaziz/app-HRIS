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
        JenisCuti::updateOrCreate([
            'n_cuti' => 'Sakit'
        ]);

        JenisCuti::updateOrCreate([
            'n_cuti' => 'Mengandung dan Melahirkan'
        ]);
    }
}
