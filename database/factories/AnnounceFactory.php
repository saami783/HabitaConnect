<?php

namespace Database\Factories;

use App\Models\Announce;
use App\Models\Equipment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announce>
 */
class AnnounceFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->paragraph,
            'address' => $this->faker->address,
            'type' => $this->faker->randomElement(['appartement', 'maison']),
            'price_per_night' => $this->faker->randomFloat(2, 50, 500),
            'user_id' => User::factory(),
        ];
    }

}
