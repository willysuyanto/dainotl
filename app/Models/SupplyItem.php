<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip',
        'trip_quantity',
        'material',
        'confirmed_quantity',
        'supply_id'
    ];

    /**
     * Get the supply that owns the SupplyItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }

}
