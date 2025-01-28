<?php

namespace Database\Factories;

use App\Models\Spot;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'license_plate' => $this->faker->unique()->regexify('[A-Z]{3}-[0-9]{3}'),
            'spot_id' => $this->faker->randomElement([null, Spot::factory()]),
        ];
    }
}
