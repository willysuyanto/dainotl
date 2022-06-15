<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    protected $fillable = [
        'so_number',
        'ref_number',
        'net_price',
        'ppn_tax',
        'ppbkb_tax',
        'pph_tax',
        'total_debit_amount'
    ];

    public function items()
    {
        return $this->hasMany(SupplyItem::class);
    }

    public function getOrderDate()
    {
        return Carbon::createFromTimestamp(strtotime($this->created_at))->format('d-m-Y');
    }

    public function getSupplyStatus()
    {
        foreach ($this->items as $item) {
            if($item['status']  == "Dalam Perjalanan") return "Dalam Proses Pengiriman";
        } 

        return "Selesai";
    }
}
