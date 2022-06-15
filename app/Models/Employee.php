<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'employee_number',
        'working_since',
        'position'
    ];

    public function loans()
    {
        return $this->hasMany(EmployeeLoan::class);
    }

    public function totalLoan(){
        $total = 0;

        if(!empty($this->loans)){
            foreach ($this->loans as $value) {
                if($value->type == "hutang")
                {
                    $total += $value->nominal;
                }
                else
                {
                    $total -= $value->nominal;
                }
            }
        }
        return $total;
    }
}
