<?php

use App\Models\ParkingLot;
use App\Models\Spot;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can list spots for a parking lot', function () {
    $parkingLot = ParkingLot::factory()->create();
    $spots = Spot::factory(3)->create(['parking_lot_id' => $parkingLot->id]);

    $response = $this->getJson("/api/parking-lots/{$parkingLot->id}/spots");

    $response->assertStatus(200)
        ->assertJsonCount(3);
});

it('can create a spot in a parking lot', function () {
    $parkingLot = ParkingLot::factory()->create();
    $spotData = [
        'number' => 1,
        'is_free' => true,
        'parking_lot_id' => $parkingLot->id
    ];

    $response = $this->postJson("/api/parking-lots/{$parkingLot->id}/spots", $spotData);

    $response->assertStatus(201);
    $this->assertDatabaseHas('spots', $spotData);
});

it('can show a spot', function () {
    $parkingLot = ParkingLot::factory()->create();
    $spot = Spot::factory()->create(['parking_lot_id' => $parkingLot->id]);

    $response = $this->getJson("/api/parking-lots/{$parkingLot->id}/spots/{$spot->id}");

    $response->assertStatus(200)
        ->assertJson([
            'id' => $spot->id,
            'number' => $spot->number,
            'is_free' => $spot->is_free,
            'parking_lot_id' => $parkingLot->id
        ]);
});

it('can update a spot', function () {
    $parkingLot = ParkingLot::factory()->create();
    $spot = Spot::factory()->create(['parking_lot_id' => $parkingLot->id]);
    $updateData = [
        'number' => 2,
        'is_free' => false,
        'parking_lot_id' => $parkingLot->id
    ];

    $response = $this->putJson("/api/parking-lots/{$parkingLot->id}/spots/{$spot->id}", $updateData);

    $response->assertStatus(200)
        ->assertJson($updateData);
    $this->assertDatabaseHas('spots', $updateData);
});

it('can delete a spot', function () {
    $parkingLot = ParkingLot::factory()->create();
    $spot = Spot::factory()->create(['parking_lot_id' => $parkingLot->id]);

    $response = $this->deleteJson("/api/parking-lots/{$parkingLot->id}/spots/{$spot->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('spots', ['id' => $spot->id]);
});
