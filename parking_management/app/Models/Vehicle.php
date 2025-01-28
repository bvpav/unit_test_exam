<?php

namespace App\Models;

use Database\Factories\VehicleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    /** @use HasFactory<VehicleFactory> */
    use HasFactory;

    protected $fillable = [
        'license_plate',
        'spot_id',
    ];

    /**
     * @return BelongsTo
     */
    public function spot(): BelongsTo
    {
        return $this->belongsTo(Spot::class);
    }
}
