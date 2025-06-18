<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Role Permissions
            'role-index',
            'role-create',
            'role-edit',
            'role-delete',

            // Departemen Permissions
            'departemen-index',
            'departemen-create',
            'departemen-edit',
            'departemen-delete',

            // Unit Permissions
            'unit-index',
            'unit-create',
            'unit-edit',
            'unit-delete',

            // Merk Permissions
            'merk-index',
            'merk-create',
            'merk-edit',
            'merk-delete',

            // Type Permissions
            'type-index',
            'type-create',
            'type-edit',
            'type-delete',

            // Item Permissions
            'item-index',
            'item-create',
            'item-edit',
            'item-delete',

            // Data Inventaris Permissions
            'inventaris-index',
            'inventaris-create',
            'inventaris-edit',
            'inventaris-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
