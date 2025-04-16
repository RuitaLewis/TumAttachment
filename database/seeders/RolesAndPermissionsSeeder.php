<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Clear cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $roles = ['Student', 'Admin', 'Institution', 'Organization'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Create demo users and assign roles
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => bcrypt('password')]
        );
        $admin->assignRole('Admin');

        $student = User::firstOrCreate(
            ['email' => 'student@example.com'],
            ['name' => 'Student User', 'password' => bcrypt('password')]
        );
        $student->assignRole('Student');

        $institution = User::firstOrCreate(
            ['email' => 'institution@example.com'],
            ['name' => 'Institution User', 'password' => bcrypt('password')]
        );
        $institution->assignRole('Institution');

        $organization = User::firstOrCreate(
            ['email' => 'organization@example.com'],
            ['name' => 'Organization User', 'password' => bcrypt('password')]
        );
        $organization->assignRole('Organization');
    }
}
