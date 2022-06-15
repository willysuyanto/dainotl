<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supply;
use App\Models\SupplyItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SupplyController extends Controller
{
    public function index()
    {
        $supplies = Supply::all();
        return view('supply.index', compact('supplies'));
    }

    public function create(Request $request) 
    {
        $shift = $request->input('shift');
        return view('supply.create', compact('shift'));
    }

    public function store(Request $request){

        $this->validate($request, [
            'so_number'=>'required',
            'net_price' => 'required',
            'ppn_tax' => 'required',
            'pph_tax' => 'required',
            'ppbkb_tax' => 'required',
            'supplyItems.*.material' => 'required',
            'supplyItems.*.trip' => 'required',
            'supplyItems.*.trip_quantity' => 'required',
        ],
        [
            'so_number.required' => 'Kolom Nomor SO tidak boleh kosong',
            'net_price.required' => 'Kolom Harga Net tidak boleh kosong',
            'ppn_tax.required' => 'Kolom PPn tidak boleh kosong',
            'ppbkb_tax.required' => 'Kolom PPBKB tidak boleh kosong',
            'pph_tax.required' => 'Kolom PPh tidak boleh kosong',
            'supplyItems.*.material.required' => 'Kolom Item Penebusan BBM tidak lengkap',
            'supplyItems.*.trip.required' => 'Kolom Item Penebusan BBM tidak lengkap',
            'supplyItems.*.trip_quantity.required' => 'Kolom Item Penebusan BBM tidak lengkap',
        ]);

        $input = $request->all();
        $input['total_debit_amount'] = $request->input('net_price') + $request->input('ppn_tax') + $request->input('pph_tax') + $request->input('ppbkb_tax'); 
        $input['status'] = 'Dalam Perjalanan';

        $supply = Supply::create($input);
        
        foreach ($request->supplyItems as $index => $item) {
            $product = Product::find($item['material']);
            $trip = $item['trip'];
            $trip_quantity = $item['trip_quantity'];
            $confirmed_quantity = $trip * $trip_quantity;
            $supplyItem = $supply->items()->create([ 
                'trip' => $trip, 
                'trip_quantity' => $trip_quantity, 
                'trip_delivered' => 0, 
                'confirmed_quantity' => $confirmed_quantity,
                'status' => 'Dalam Perjalanan',
                'shift' => '1',
            ]);
            $supplyItem->product()->attach($product);
        }

        if($supply->shift == 1){
            return redirect()->route('shift.first')->with('success', 'Berhasil menyimpan perubahan data penebusan BBM');
        } else if($supply->shift == 2){
            return redirect()->route('shift.second')->with('success', 'Berhasil menyimpan perubahan data penebusan BBM');
        } else if($supply->shift == 3){
            return redirect()->route('shift.third')->with('success', 'Berhasil menyimpan perubahan data penebusan BBM');
        }else {
            return redirect()->route('supply.index')->with('success', 'Berhasil menyimpan perubahan data penebusan BBM');
        }
    }

    public function details($id){
        $supply = Supply::find($id);
        return view('supply.show', compact('supply'));
    }

    public function edit($id){
        $supply = Supply::find($id);
        return view('supply.edit', compact('supply'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'so_number'=>'required',
            'net_price' => 'required',
            'ppn_tax' => 'required',
            'pph_tax' => 'required',
            'ppbkb_tax' => 'required',
            'supplyItems.*.material' => 'required',
            'supplyItems.*.trip' => 'required',
            'supplyItems.*.trip_quantity' => 'required',
        ],
        [
            'so_number.required' => 'Kolom Nomor SO tidak boleh kosong',
            'net_price.required' => 'Kolom Harga Net tidak boleh kosong',
            'ppn_tax.required' => 'Kolom PPn tidak boleh kosong',
            'ppbkb_tax.required' => 'Kolom PPBKB tidak boleh kosong',
            'pph_tax.required' => 'Kolom PPh tidak boleh kosong',
            'supplyItems.*.material.required' => 'Kolom Item Penebusan BBM tidak lengkap',
            'supplyItems.*.trip.required' => 'Kolom Item Penebusan BBM tidak lengkap',
            'supplyItems.*.trip_quantity.required' => 'Kolom Item Penebusan BBM tidak lengkap',
        ]);
        
        $supply = Supply::find($id);
        $input = $request->all();
        $input['total_debit_amount'] = $request->input('net_price') + $request->input('ppn_tax') + $request->input('pph_tax') + $request->input('ppbkb_tax'); 
        $supply->update($input);

        foreach ($request->supplyItems as $index => $item) {
            $product = Product::find($item['material']);
            $trip = $item['trip'];
            $trip_quantity = $item['trip_quantity'];
            $confirmed_quantity = $trip * $trip_quantity;
            $supplyItem = $supply->items()->where('id',$item['id']);
           
            $supplyItem->update([ 
                'trip' => $trip, 
                'trip_quantity' => $trip_quantity, 
                'confirmed_quantity' => $confirmed_quantity,
            ]);

            DB::table('product_supply_item')->where('supply_item_id', $item['id'])->delete();
            $supplyItem->get()->first()->product()->attach($item['material']);
        }

        if($supply->shift == "shift1"){
            return redirect()->route('shift.first')->with('success', 'Berhasil menyimpan perubahan data penebusan BBM');
        } else if($supply->shift == "shift2"){
            return redirect()->route('shift.second')->with('success', 'Berhasil menyimpan perubahan data penebusan BBM');
        } else if($supply->shift == "shift3"){
            return redirect()->route('shift.third')->with('success', 'Berhasil menyimpan perubahan data penebusan BBM');
        }else {
            return redirect()->route('supply.index')->with('success', 'Berhasil menyimpan perubahan data penebusan BBM');
        }
        //return $request;
    }

    public function delete($id){
       $deleted = Supply::find($id);
       //$deleted_so_number = $deleted->so_number;
       $message = "Penebusan BBM telah dihapus";
       $deleted->delete();

       return $message;
    }

}
