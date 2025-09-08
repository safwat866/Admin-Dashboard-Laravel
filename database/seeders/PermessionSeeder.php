<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view dashboard']);
        Permission::create(['name' => 'add product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'edit roles']);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo([
            'view dashboard',
            'add product',
            'edit product',
            'edit users',
            'edit roles'
        ]);

        $superUser = Role::firstOrCreate(['name' => 'superUser']);
        $superUser->givePermissionTo([
            'view dashboard',
        ]);
    }
}
