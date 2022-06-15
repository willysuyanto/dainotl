<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLoan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nominal',
        'type',
        'notes',
    ];

    public function employee()
    {
        $this->belongsTo(employee::class);
    }
}
