<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::updateOrCreate(
            [
                'name' => 'Admin'
            ],
            [
                'name' => 'Admin'
            ]
        );

        $roleHrd = Role::updateOrCreate(
            [
                'name' => 'HRD'
            ],
            [
                'name' => 'HRD'
            ]
        );


        $roleKaryawan = Role::updateOrCreate(
            [
                'name' => 'Karyawan'
            ],
            [
                'name' => 'Karyawan'
            ]
        );

        $permission = Permission::updateOrCreate(
            [
                'name' => 'viewAdmin'
            ],
            [
                'name' => 'viewAdmin'
            ]
        );
        $permission1 = Permission::updateOrCreate(
            [
                'name' => 'viewHRD'
            ],
            [
                'name' => 'viewHRD'
            ]
        );

        $permission3 = Permission::updateOrCreate(
            [
                'name' => 'viewKaryawan'
            ],
            [
                'name' => 'viewKaryawan'
            ]
        );
        $roleAdmin->givePermissionTo($permission);
        $roleHrd->givePermissionTo($permission1);
        $roleKaryawan->givePermissionTo($permission3);

        $admin = User::find(1);
        $admin->assignRole('Admin');
        $hrd = User::find(2);
        $hrd->assignRole('HRD');
    }
}
