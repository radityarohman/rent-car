<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReturnCar extends Model
{
    use HasFactory;
    protected $fillable = [
        "tenant",
        "no_car",
        "id_penalties",
        "date_borrow",
        "date_return",
        "discount",
        "total",
    ];

    /**
     * Get all of the comments for the ReturnCar
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penalties(): HasMany
    {
        return $this->hasMany(Penalties::class, 'id', 'id_penalties');
    }
}
