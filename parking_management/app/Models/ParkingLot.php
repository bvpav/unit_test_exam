<?php

namespace App\Models;

use Database\Factories\ParkingLotFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ParkingLot extends Model
{
    /** @use HasFactory<ParkingLotFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
    ];

    /**
     * @return HasMany
     */
    public function spots(): HasMany
    {
        return $this->hasMany(Spot::class);
    }
}
