<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Announce;
use App\Models\AnnounceEquipment;
use App\Models\Comment;
use App\Models\Equipment;
use App\Models\Message;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\User;
use Database\Factories\EquipmentFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();
        $announces = Announce::factory(10)->create();
        $reservations = Reservation::factory(10)->create();
        $review = Review::factory(10)->create();
        $equipments = Equipment::factory(10)->create();

        foreach ($announces as $announce) {
            foreach ($equipments as $equipment) {
                AnnounceEquipment::factory()->create([
                    'announce_id' => $announce->id,
                    'equipment_id' => $equipment->id,
                ]);
            }
        }

    }
}
