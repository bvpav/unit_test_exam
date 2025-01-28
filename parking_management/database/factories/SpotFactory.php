<?php

namespace Database\Factories;

use App\Models\ParkingLot;
use App\Models\Spot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Spot>
 */
class SpotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->numberBetween(1, 100),
            'is_free' => $this->faker->boolean,
            'parking_lot_id' => ParkingLot::factory(),
        ];
    }
}
