<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = Role::create([
            'name' => 'Super Admin',
            'slug' => 'super_admin',
        ]);

        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);

        Role::create([
            'name' => 'User',
            'slug' => 'user',
        ]);

        Role::create([
            'name' => 'Sub User',
            'slug' => 'sub_user',
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role_id' => $superAdmin->id,
            'parent_id' => null,
            'status' => true,
        ]);
    }
}