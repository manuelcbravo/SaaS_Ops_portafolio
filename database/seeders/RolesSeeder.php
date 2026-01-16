<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        // Opcional: permisos base (puedes crecerlos después)
        $permissions = [
            'view dashboard',
            'manage clients',
            'manage projects',
            'manage tasks',
            'manage files',
            'manage users',
        ];

        foreach ($permissions as $perm) {
            Permission::findOrCreate($perm);
        }

        $owner = Role::findOrCreate('Owner');
        $admin = Role::findOrCreate('Admin');
        $member = Role::findOrCreate('Member');

        $owner->syncPermissions($permissions);
        $admin->syncPermissions([
            'view dashboard',
            'manage clients',
            'manage projects',
            'manage tasks',
            'manage files',
        ]);
        $member->syncPermissions([
            'view dashboard',
            'manage tasks',
            'manage files',
        ]);
    }
}
