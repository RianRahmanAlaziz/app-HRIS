<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@gmail.com'
            ],
            [
                'nama' => 'Admin',
                'password' => bcrypt('admin'),
                'email_verified_at' => now()
            ]
        );

        User::updateOrCreate(
            [
                'email' => 'hrd@gmail.com'
            ],
            [
                'nama' => 'HRD',
                'password' => bcrypt('hrd'),
                'email_verified_at' => now()
            ]
        );

        User::updateOrCreate(
            [
                'email' => 'bendahara@gmail.com'
            ],
            [
                'nama' => 'Bendahara',
                'password' => bcrypt('bendahara'),
                'email_verified_at' => now()
            ]
        );
    }
}
