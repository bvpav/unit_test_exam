<?php

namespace App\Models;

use Database\Factories\SpotFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Spot extends Model
{
    /** @use HasFactory<SpotFactory> */
    use HasFactory;

    protected $fillable = [
        'number',
        'is_free',
        'parking_lot_id',
    ];

    /**
     * @return BelongsTo
     */
    public function parkingLot(): BelongsTo
    {
        return $this->belongsTo(ParkingLot::class);
    }

    /**
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
