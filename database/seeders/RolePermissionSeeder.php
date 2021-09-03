<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = collect(['admin', 'instructor']);
        $permissions = collect(['create playlists', 'create tags', 'modify tags']);

        $roles->each(function ($role) {
            $roleCreated = Role::create([
                'name' => $role,
            ]);
        });
        $permissions->each(function ($permission) {
            Permission::create([
                'name' => $permission
            ]);
        });

        $instructor = Role::find(2);
        $instructor->givePermissionTo('create playlists');
        $instructor->givePermissionTo('create tags');
        $instructor->givePermissionTo('modify tags');
    }
}
