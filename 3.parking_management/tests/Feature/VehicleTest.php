<?php

use App\Models\ParkingLot;
use App\Models\Spot;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can list vehicles for a spot', function () {
    $parkingLot = ParkingLot::factory()->create();
    $spot = Spot::factory()->create(['parking_lot_id' => $parkingLot->id]);
    $vehicle = Vehicle::factory()->create(['spot_id' => $spot->id]);

    $response = $this->getJson("/api/parking-lots/{$parkingLot->id}/spots/{$spot->id}/vehicles");

    $response->assertStatus(200)
        ->assertJson($vehicle->toArray());
});

it('can create a vehicle in a spot', function () {
    $parkingLot = ParkingLot::factory()->create();
    $spot = Spot::factory()->create(['parking_lot_id' => $parkingLot->id]);
    $vehicleData = [
        'license_plate' => 'ABC-123'
    ];

    $response = $this->postJson("/api/parking-lots/{$parkingLot->id}/spots/{$spot->id}/vehicles", $vehicleData);

    $response->assertStatus(201);
    $this->assertDatabaseHas('vehicles', [
        'license_plate' => 'ABC-123',
        'spot_id' => $spot->id
    ]);
    $this->assertDatabaseHas('spots', [
        'id' => $spot->id,
        'is_free' => false
    ]);
});

it('can show a vehicle', function () {
    $parkingLot = ParkingLot::factory()->create();
    $spot = Spot::factory()->create(['parking_lot_id' => $parkingLot->id]);
    $vehicle = Vehicle::factory()->create(['spot_id' => $spot->id]);

    $response = $this->getJson("/api/parking-lots/{$parkingLot->id}/spots/{$spot->id}/vehicles/{$vehicle->id}");

    $response->assertStatus(200)
        ->assertJson([
            'id' => $vehicle->id,
            'license_plate' => $vehicle->license_plate,
            'spot_id' => $spot->id
        ]);
});

it('can update a vehicle', function () {
    $parkingLot = ParkingLot::factory()->create();
    $spot = Spot::factory()->create(['parking_lot_id' => $parkingLot->id]);
    $vehicle = Vehicle::factory()->create(['spot_id' => $spot->id]);
    $updateData = [
        'license_plate' => 'XYZ-789'
    ];

    $response = $this->putJson("/api/parking-lots/{$parkingLot->id}/spots/{$spot->id}/vehicles/{$vehicle->id}", $updateData);

    $response->assertStatus(200);
    $this->assertDatabaseHas('vehicles', [
        'id' => $vehicle->id,
        'license_plate' => 'XYZ-789',
        'spot_id' => $spot->id
    ]);
});

it('can delete a vehicle', function () {
    $parkingLot = ParkingLot::factory()->create();
    $spot = Spot::factory()->create(['parking_lot_id' => $parkingLot->id]);
    $vehicle = Vehicle::factory()->create(['spot_id' => $spot->id]);

    $response = $this->deleteJson("/api/parking-lots/{$parkingLot->id}/spots/{$spot->id}/vehicles/{$vehicle->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('vehicles', ['id' => $vehicle->id]);
    $this->assertDatabaseHas('spots', [
        'id' => $spot->id,
        'is_free' => true
    ]);
});
