<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift',
        'first_totalizer',
        'last_totalizer',
        'sales_on_litre',
        'sales_on_rupiah',
    ];

    public function nozzle(){
        return $this->belongsTo(Nozzle::class);
    }
}
