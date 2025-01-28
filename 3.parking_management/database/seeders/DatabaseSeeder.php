<?php

namespace Database\Seeders;

use App\Models\ParkingLot;
use App\Models\Spot;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $lots = ParkingLot::factory(10)->create();

        $lots->each(function (ParkingLot $lot) {
            $spots = Spot::factory(10)->create([
                'parking_lot_id' => $lot->id,
            ]);

            $spots->random(5)->each(function (Spot $spot) {
                Vehicle::factory()->create([
                    'spot_id' => $spot->id,
                ]);

                $spot->update([
                    'is_free' => false,
                ]);
            });
        });
    }
}
