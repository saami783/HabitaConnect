<?php

namespace Database\Factories;

use App\Models\Announce;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->text,
            'note' => $this->faker->randomNumber([1,2,3,4,5]),
            'announce_id' => Announce::factory(),
            'user_id' => User::factory(),
        ];
    }
}
