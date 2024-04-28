<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penalties extends Model
{
    use HasFactory;

    protected $fillable = [
        "penalties_name",
        "description",
        "no_car",
        "penalties_total",
    ];

    /**
     * Get the user that owns the Penalties
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function returnCar(): BelongsTo
    {
        return $this->belongsTo(ReturnCar::class, 'foreign_key', 'other_key');
    }
}
