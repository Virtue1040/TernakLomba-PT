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
        ], [
            'name' => 'lomba-edit'
        ], [
            'name' => 'lomba-delete'
        ],

        // Team Permission
        [
            'name' => 'team-approve'
        ], [
            'name' => 'team-decline'
        ], [
            'name' => 'team-read'
        ], [
            'name' => 'team-create'
        ], [
            'name' => 'team-edit'
        ], [
            'name' => 'team-delete'
        ]);

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
        
        // Assign the permission to the role
        $Admin->syncPermissions($lomba_read, $lomba_create, $lomba_edit, $lomba_delete, $team_approve, $team_decline, $team_read, $team_create, $team_edit, $team_delete);
        $Penyelenggara->syncPermissions($lomba_read, $lomba_create, $lomba_edit, $lomba_delete, $team_approve, $team_decline, $team_read, $team_create, $team_edit, $team_delete);
        $User->syncPermissions($lomba_read, $team_read);
    }
}
