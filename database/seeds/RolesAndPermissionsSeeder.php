<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role_admin = Role::create(['name' => 'admin']);
        $role_user = Role::create(['name' => 'user']);

        $permissions = collect([
            'index users',
            'create users',
            'edit users',
            'delete users',
            'index email',
            'create email',
            //
        ]);

        $permissions_by_role = [
            'admin' => [
                'index users',
                'create users',
                'edit users',
                'delete users',
                'index email',
                'create email',
            ],

            'user' => [
                'index email',
                'create email',
            ],

            
        ];

        $permissions = $permissions->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());

        $role_admin->syncPermissions($permissions_by_role['admin']);
        $role_user->syncPermissions($permissions_by_role['user']);
    }
}
