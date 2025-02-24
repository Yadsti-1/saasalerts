<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        // Crear permisos básicos
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        // Asignar permisos al rol admin
        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo(Permission::all());
    }
}