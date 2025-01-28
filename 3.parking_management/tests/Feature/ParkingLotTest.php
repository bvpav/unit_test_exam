<?php

use App\Models\ParkingLot;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can list parking lots', function () {
    $parkingLots = ParkingLot::factory(3)->create();

    $response = $this->getJson('/api/parking-lots');

    $response->assertStatus(200)
        ->assertJsonCount(3)
        ->assertJsonStructure([
            '*' => ['id', 'name', 'address', 'created_at', 'updated_at']
        ]);
});

it('can create a parking lot', function () {
    $parkingLotData = [
        'name' => 'Test Parking',
        'address' => '123 Test Street'
    ];

    $response = $this->postJson('/api/parking-lots', $parkingLotData);

    $response->assertStatus(201)
        ->assertJson($parkingLotData);

    $this->assertDatabaseHas('parking_lots', $parkingLotData);
});

it('can show a parking lot', function () {
    $parkingLot = ParkingLot::factory()->create();

    $response = $this->getJson("/api/parking-lots/{$parkingLot->id}");

    $response->assertStatus(200)
        ->assertJson([
            'id' => $parkingLot->id,
            'name' => $parkingLot->name,
            'address' => $parkingLot->address,
        ]);
});

it('can update a parking lot', function () {
    $parkingLot = ParkingLot::factory()->create();
    $updateData = [
        'name' => 'Updated Parking',
        'address' => '456 Update Street'
    ];

    $response = $this->putJson("/api/parking-lots/{$parkingLot->id}", $updateData);

    $response->assertStatus(200)
        ->assertJson($updateData);

    $this->assertDatabaseHas('parking_lots', $updateData);
});

it('can delete a parking lot', function () {
    $parkingLot = ParkingLot::factory()->create();

    $response = $this->deleteJson("/api/parking-lots/{$parkingLot->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('parking_lots', ['id' => $parkingLot->id]);
});
