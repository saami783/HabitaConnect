<?php

namespace Database\Factories;

use App\Models\Announce;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AnnounceEquipment>
 */
class AnnounceEquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'announce_id' => Announce::factory(),
            'equipment_id' => Equipment::factory(),
        ];
    }

}
