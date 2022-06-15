<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nozzle;

class SalesController extends Controller
{
    public function store(Request $request, $shift, $id){

        $this->validate($request, [
            'new_totalizer' => 'required|gte:last_totalizer',
        ],
        [
            'new_totalizer.required' => 'Totalizer akhir tidak boleh kosong, perubahan tidak disimpan',
            'new_totalizer.gte' => 'Totalizer Akhir tidak boleh lebih kecil dari Totalizer Awal'
        ]);

        $nozzle = Nozzle::find($id);
        $quantity = $request->input('new_totalizer')-$request->input('last_totalizer');
        $amount = $quantity * $nozzle->product->selling_price;
        $nozzle->sales()->updateOrCreate([
            'created_at' => $nozzle->sales->where('created_at', '>', date('Y-m-d'))->first()->created_at ?? null,
            'nozzle_id' => $nozzle->id,
            'shift' => $shift
        ],
        [
            'nozzle_id' => $id,
            'first_totalizer' => $request->input('last_totalizer'),
            'last_totalizer' => $request->input('new_totalizer'),
            'sales_on_litre' => $quantity,
            'sales_on_rupiah' => $amount,
            'shift' => $shift
        ]);
        $nozzle->update([
            'last_totalizer' => $request->input('new_totalizer')
        ]);

        return "Berhasil menyimpan data totalizer akhir";
    }
}