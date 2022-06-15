<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Nozzle extends Model
{
    use HasFactory;

    protected $fillable = [
        'group',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sales()
    {
        return $this->hasMany(Sales::class);
    }

    public function todaySales($shift)
    {
        return $this->sales->where('created_at', '>=', Carbon::today())->where('shift', '=', $shift);
    }

    public function yesterdaySales($shift)
    {
        return $this->sales()->whereDate('created_at', Carbon::yesterday())->where('shift', '=', $shift)->get();
    }

}
