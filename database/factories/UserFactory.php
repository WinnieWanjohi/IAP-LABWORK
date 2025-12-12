<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roles = \App\Models\Role::pluck('id')->toArray();
        
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => fake()->randomElement($roles),
            'phone' => fake()->phoneNumber(),
            'is_active' => fake()->boolean(80), // 80% chance of being active
            'last_login_at' => fake()->optional()->dateTimeThisYear(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the user is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the user is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Indicate that the user is an admin.
     */
    public function admin(): static
    {
        $adminRole = \App\Models\Role::where('slug', 'admin')->first();
        
        return $this->state(fn (array $attributes) => [
            'role_id' => $adminRole->id,
        ]);
    }

    /**
     * Indicate that the user is a manager.
     */
    public function manager(): static
    {
        $managerRole = \App\Models\Role::where('slug', 'manager')->first();
        
        return $this->state(fn (array $attributes) => [
            'role_id' => $managerRole->id,
        ]);
    }
}