<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nozzle;
use App\Models\Product;
use App\Models\Customer;
use Carbon\Carbon;

class ShiftController extends Controller
{
    public function firstShift()
    {
        $nozzles = Nozzle::all();
        foreach ($nozzles as $nozzle) {
            $nozzle->today_sales = $nozzle->sales->where('created_at', '>=', Carbon::today())->where('shift', '=', '1')->first();
            $nozzle->past_sales = $nozzle->sales->where('created_at', '<', Carbon::today())->sortByDesc('id')->first();
        }
        info($nozzles);
        $products = Product::with(['stocks', 'supplyItem'])->get();
        $customers = Customer::all();
        
        $todaySales = Nozzle::whereHas('sales', function($query) { 
            $query->where('created_at', '>=', Carbon::today())->where('shift', '=', '1');
        })->get();
        $totalSalesAmount = 0;
        $totalSalesQuantity = 0;

        foreach ($todaySales as $sls) {
            $qty = $sls->sales->where('created_at', '>=', Carbon::today())->where('shift', '=', '1')->sum('sales_on_litre');
            $amt = $qty * $sls->product->selling_price;
            $totalSalesQuantity += number_format($qty,1);
            $totalSalesAmount += $amt;
        }

        return view('shift.first', compact('nozzles','totalSalesAmount', 'totalSalesQuantity', 'products', 'customers'));
    }

    public function secondShift()
    {
        $nozzles = Nozzle::all();
        $todaySales = Nozzle::whereHas('sales', function($query) { 
            $query->where('created_at', '>=', Carbon::today())->where('shift', '=', 2);
        })->get();
        $totalSalesAmount = 0;
        $totalSalesQuantity = 0;

        foreach ($todaySales as $sls) {
            $qty = $sls->sales->where('shift', '=', 2)->sum('last_totalizer') - $sls->sales->where('shift', '=', 2)->sum('first_totalizer');
            $amt = $qty * $sls->product->selling_price;
            $totalSalesAmount += $amt;
            $totalSalesQuantity += $qty;
        }

        return view('shift.second', compact('nozzles','totalSalesAmount', 'totalSalesQuantity'));
    }

    public function thirdShift()
    {
        return view('shift.third');
    }
}
