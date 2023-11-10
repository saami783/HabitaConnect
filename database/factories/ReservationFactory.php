<?php

namespace Database\Factories;

use App\Models\Announce;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'end_at' => $this->faker->date,
            'begin_at' => $this->faker->date,
            'user_id' => User::factory(),
            'announce_id' => Announce::factory(),
            'price' => 12.35,
            'status' => $this->faker->randomElement(['En cours', 'Paiement accepté', 'Annulé', 'En attente d\'une réponse du propriétaire'])
        ];
    }
}
