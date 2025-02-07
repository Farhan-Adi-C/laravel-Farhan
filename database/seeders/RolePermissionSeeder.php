<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        Permission::create(['name' => 'siswa-index']);
        Permission::create(['name' => 'siswa-store']);
        Permission::create(['name' => 'siswa-show']);
        Permission::create(['name' => 'siswa-update']);
        Permission::create(['name' => 'siswa-delete']);

        Permission::create(['name' => 'phone-index']);
        Permission::create(['name' => 'phone-store']);
        Permission::create(['name' => 'phone-show']);
        Permission::create(['name' => 'phone-update']);
        Permission::create(['name' => 'phone-delete']);

        Permission::create(['name' => 'hobby-index']);
        Permission::create(['name' => 'hobby-store']);
        Permission::create(['name' => 'hobby-show']);
        Permission::create(['name' => 'hobby-update']);
        Permission::create(['name' => 'hobby-delete']);

        Permission::create(['name' => 'blog-index']);
        Permission::create(['name' => 'blog-store']);
        Permission::create(['name' => 'blog-show']);
        Permission::create(['name' => 'blog-update']);
        Permission::create(['name' => 'blog-delete']);

        $superAdmin->givePermissionTo([
            'siswa-index', 'siswa-store', 'siswa-show', 'siswa-update', 'siswa-delete',
            'phone-index',  'phone-store','phone-show', 'phone-update', 'phone-delete',
            'hobby-index', 'hobby-store', 'hobby-show','hobby-update',  'hobby-delete',
            'blog-index',  'blog-store',  'blog-show','blog-update', 'blog-delete',
        ]);
    
        $admin->givePermissionTo([
            'siswa-index',
            'phone-index', 
            'hobby-index',
            'blog-index', 
        ]);

        $user->givePermissionTo([
            'blog-index',
        ]);
    }
}
