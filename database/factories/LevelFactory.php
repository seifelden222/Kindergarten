<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Level>
 */
class LevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'فصل '.$this->faker->unique()->randomElement(['الزهور', 'الفراشات', 'النجوم', 'الأبطال', 'الطيور']),
            'children_count' => $this->faker->numberBetween(5, 30),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'accent_color' => $this->faker->randomElement(['#0ea60e', '#3b82f6', '#a855f7', '#f97316']),
            'notes' => $this->faker->optional()->sentence(),
            'user_id' => User::factory()->state([
                'role' => 'teacher',
            ]),
        ];
    }
}
