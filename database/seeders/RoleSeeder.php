<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrator',
                'slug' => 'admin',
                'description' => 'Full system access'
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Can manage users and content'
            ],
            [
                'name' => 'User',
                'slug' => 'user',
                'description' => 'Regular user with basic access'
            ],
            [
                'name' => 'Editor',
                'slug' => 'editor',
                'description' => 'Can edit content'
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        $this->command->info('Roles seeded successfully!');
    }
}