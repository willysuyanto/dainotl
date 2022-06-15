<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'purchase_price',
        'selling_price',
        'quantity_per_trip',
        'color',
    ];

    public function supplyItem(){
        return $this->belongsToMany(SupplyItem::class);
    }

    public function stocks(){
        return $this->hasMany(Stock::class);
    }

    public function nozzles(){
        return $this->hasMany(Nozzle::class);
    }

    public function stockIn(){
        return $this->hasMany(StockIn::class);
    }

    public function stockOut(){
        return $this->hasMany(StockOut::class);
    }

}
