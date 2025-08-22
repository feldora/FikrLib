<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'view dashboard',
            'manage books',
            'manage members',
            'manage loans',
            'create book',
            'edit book',
            'delete book',
            'create member',
            'edit member',
            'delete member',
            'create loan',
            'edit loan',
            'delete loan',
            'manage settings'
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = \Spatie\Permission\Models\Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($permissions);

        $librarianRole = \Spatie\Permission\Models\Role::create(['name' => 'librarian']);
        $librarianRole->givePermissionTo([
            'view dashboard',
            'manage books',
            'manage members',
            'manage loans',
            'create book',
            'edit book',
            'create member',
            'edit member',
            'create loan',
            'edit loan'
        ]);

        // Assign admin role to super admin user
        $admin = \App\Models\User::where('email', 'admin@fikrlib.test')->first();
        if ($admin) {
            $admin->assignRole('admin');
        }
    }
}
