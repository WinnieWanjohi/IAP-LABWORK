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
        // Get roles
        $adminRole = Role::where('slug', 'admin')->first();
        $userRole = Role::where('slug', 'user')->first();

        // Create admin user
        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@thibitisha.test',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole->id,
        ]);

        // Create regular user
        User::create([
            'name' => 'John Doe',
            'email' => 'john@thibitisha.test',
            'password' => Hash::make('password123'),
            'role_id' => $userRole->id,
        ]);

        // Create 8 more random users
        User::factory(8)->create();

        $this->command->info('Users seeded successfully!');
    }
}