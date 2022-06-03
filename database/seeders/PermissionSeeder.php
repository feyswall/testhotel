<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        $owner_role = Role::create([
            'name' => 'owner',
        ]);

        DB::table('permissions')->delete();
        $ownerDefaultPermissions = [
            // users crud permissions
            'index_users',
            'create_users',
            'show_users',
            'edit_users',
            'update_users',
            'destroy_users',
            // users universal permission is known as
            // grob permission
            'grob_users',
        ];

        foreach( $ownerDefaultPermissions as $permission ){
            Permission::create( ['name' => $permission] );
        }

        $owner_role->syncPermissions( $ownerDefaultPermissions );

    }
}
