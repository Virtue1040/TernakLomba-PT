<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_names = array([
            'name' => 'Admin', 
        ], [
            'name' => 'Penyelenggara'
        ], [
            'name' => 'User'
        ]);

        $permissions = array(
        // Lomba Permission
        [
            'name' => 'lomba-read'
        ], [
            'name' => 'lomba-create'
        ],[
            'name' => 'lomba-request'
        ],[
            'name' => 'lomba-approve'
        ], [
            'name' => 'lomba-edit'
        ], [
            'name' => 'lomba-delete'
        ], [
            'name' => 'lomba-setwinner'
        ],

        // Team Permission
        [
            'name' => 'team-approve'
        ], [
            'name' => 'team-decline'
        ], [
            'name' => 'team-join',
        ],[
            'name' => 'team-read'
        ], [
            'name' => 'team-create'
        ], [
            'name' => 'team-edit'
        ], [
            'name' => 'team-delete'
        ],
        
        // Lomba Member Permission
        [
            'name' => 'member-read'
        ], [
            'name' => 'member-create'
        ], [
            'name' => 'member-edit'
        ], [
            'name' => 'member-delete'
        ], [
            'name' => 'member-join'
        ],
        
        // Type Hadiah Permission
        [
            'name' => 'typeHadiah-read',
        ], [
            'name' => 'typeHadiah-create',
        ], [
            'name' => 'typeHadiah-edit',
        ], [
            'name' => 'typeHadiah-delete',
        ],

        // Lomba Album Permission
        [
            'name' => 'lombaAlbum-read',
        ], [
            'name' => 'lombaAlbum-create',
        ], [
            'name' => 'lombaAlbum-edit',
        ], [
            'name' => 'lombaAlbum-delete',
        ],

        // Lomba Hadiah Permission
        [
            'name' => 'lombaHadiah-read',
        ], [
            'name' => 'lombaHadiah-create',
        ], [
            'name' => 'lombaHadiah-edit',
        ], [
            'name' => 'lombaHadiah-delete',
        ],

        // Lomba Category Permission
        [
            'name' => 'lombaCategory-read',
        ], [
            'name' => 'lombaCategory-create',
        ], [
            'name' => 'lombaCategory-edit',
        ], [
            'name' => 'lombaCategory-delete',
        ]
        );

        // Create the role and the permission
        foreach ($role_names as $role_name) {
            Role::create($role_name);
        }
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Assign the permission to the role
        $Admin = Role::findByName('Admin');
        $Penyelenggara = Role::findByName('Penyelenggara');
        $User = Role::findByName('User');

        // Lomba Permission
        $lomba_read = Permission::findByName('lomba-read');
        $lomba_request = Permission::findByName('lomba-request');
        $lomba_approve = Permission::findByName('lomba-approve');
        $lomba_create = Permission::findByName('lomba-create');
        $lomba_edit = Permission::findByName('lomba-edit');
        $lomba_delete = Permission::findByName('lomba-delete');

        // Team Permission
        $team_approve = Permission::findByName('team-approve');
        $team_decline = Permission::findByName('team-decline');
        $team_read = Permission::findByName('team-read');
        $team_create = Permission::findByName('team-create');
        $team_edit = Permission::findByName('team-edit');
        $team_delete = Permission::findByName('team-delete');

        // Lomba Member Permission
        $member_read = Permission::findByName('member-read');
        $member_create = Permission::findByName('member-create');
        $member_edit = Permission::findByName('member-edit');
        $member_delete = Permission::findByName('member-delete');
        $member_join = Permission::findByName('member-join');

        // Type Hadiah Permission
        $typeHadiah_read = Permission::findByName('typeHadiah-read');
        $typeHadiah_create = Permission::findByName('typeHadiah-create');
        $typeHadiah_edit = Permission::findByName('typeHadiah-edit');
        $typeHadiah_delete = Permission::findByName('typeHadiah-delete');

        // Lomba Album Permission
        $lombaAlbum_read = Permission::findByName('lombaAlbum-read');
        $lombaAlbum_create = Permission::findByName('lombaAlbum-create');
        $lombaAlbum_edit = Permission::findByName('lombaAlbum-edit');
        $lombaAlbum_delete = Permission::findByName('lombaAlbum-delete');

        // Lomba Hadiah Permission
        $lombaHadiah_read = Permission::findByName('lombaHadiah-read');
        $lombaHadiah_create = Permission::findByName('lombaHadiah-create');
        $lombaHadiah_edit = Permission::findByName('lombaHadiah-edit');
        $lombaHadiah_delete = Permission::findByName('lombaHadiah-delete');

        // Lomba Category Permission
        $lombaCategory_read = Permission::findByName('lombaCategory-read');
        $lombaCategory_create = Permission::findByName('lombaCategory-create');
        $lombaCategory_edit = Permission::findByName('lombaCategory-edit');
        $lombaCategory_delete = Permission::findByName('lombaCategory-delete');
        
        // Sync All Permission to Admin
        $Admin->syncPermissions(Permission::all());

        // Sync Permission to Penyelenggara
        $Penyelenggara->syncPermissions($lomba_read, $lomba_create, $lomba_edit, $lomba_delete, $lomba_request,
        $team_approve, $team_decline, $team_read, $team_create, $team_edit, $team_delete,
        $member_read, $member_delete,
        $typeHadiah_read, $typeHadiah_create, $typeHadiah_edit, $typeHadiah_delete,
        $lombaAlbum_read, $lombaAlbum_create, $lombaAlbum_edit, $lombaAlbum_delete,
        $lombaHadiah_read, $lombaHadiah_create, $lombaHadiah_edit, $lombaHadiah_delete);

        // Sync Permission to User
        $User->syncPermissions($lomba_read, $lomba_create, $lomba_edit, $lomba_delete, $lomba_request,
        $team_approve, $team_decline, $team_read, $team_create, $team_edit, $team_delete,
        $member_read, $member_delete,
        $typeHadiah_read, $typeHadiah_create, $typeHadiah_edit, $typeHadiah_delete,
        $lombaAlbum_read, $lombaAlbum_create, $lombaAlbum_edit, $lombaAlbum_delete,
        $lombaHadiah_read, $lombaHadiah_create, $lombaHadiah_edit, $lombaHadiah_delete);
    }
}
