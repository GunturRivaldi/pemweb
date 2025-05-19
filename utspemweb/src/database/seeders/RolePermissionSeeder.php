<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Nonaktifkan pengecekan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate tabel-tabel child dulu
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('role_has_permissions')->truncate();

        // Truncate tabel parent
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();

        // Aktifkan kembali pengecekan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Buat role dasar
        $admin = Role::create(['name' => 'admin']);
        $guru = Role::create(['name' => 'guru']);

        // Buat permissions
        $permissions = [
            'lihat data',
            'tambah data',
            'edit data',
            'hapus data',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Berikan semua permission ke admin
        $admin->syncPermissions(Permission::all());
    }
}
