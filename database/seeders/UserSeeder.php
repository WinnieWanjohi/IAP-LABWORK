<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Get admin role
        $adminRole = Role::where('slug', 'admin')->first();
        
        if (!$adminRole) {
            $adminRole = Role::create([
                'name' => 'Administrator',
                'slug' => 'admin',
                'description' => 'Full system access'
            ]);
        }

        // Create admin user
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'phone' => '+254700000001',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create a few more users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role_id' => Role::where('slug', 'manager')->first()->id ?? null,
            'phone' => '+254700000002',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role_id' => Role::where('slug', 'editor')->first()->id ?? null,
            'phone' => '+254700000003',
            'is_active' => true,
        ]);

        // Create an inactive user
        User::create([
            'name' => 'Inactive User',
            'email' => 'inactive@example.com',
            'password' => Hash::make('password'),
            'role_id' => Role::where('slug', 'viewer')->first()->id ?? null,
            'phone' => '+254700000004',
            'is_active' => false,
        ]);
    }
}