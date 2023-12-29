<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
        return [
            'nev' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telefonszam' => fake()->phoneNumber(),
            'lakcim' => fake()->address(),
            'szuletesi_ev' => fake()->year(),
            'password' => static::$password ??= Hash::make('password')
        ];
    }
}
