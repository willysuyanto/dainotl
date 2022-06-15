<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock; 
use App\Models\Supply; 

use Carbon\Carbon;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Product::all();
        return view('stock.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $shift = $request->input('shift');
        $supply = Supply::all();
        return view('stock.create', compact('supply', 'shift'));
    }

    public function createInitialStock($id)
    {
        $product = Product::find($id);
        return view('stock.stock-awal', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'so_number' => 'required',
            'selected_item' => 'required'
        ],
        [   
            'so_number.required'    => 'Pilih nomor SO terlebih dahulu',
            'selected_item.required'    => 'Pilih item BBM yang datang terlebih dahulu',
        ]);

        $input = $request->all();
        $supply = Supply::find($request->input('so_number'));
        $supply_item = $supply->items()->where('id',$request->input('selected_item'))->get();
        $product = $supply_item->first()->product()->get();
        //info($supply_item->first()->product()->get());
        $input['quantity'] = $supply_item->first()->trip_quantity;
        $input['stock_date'] = Carbon::now();
        $input['stock_type'] = 'stock_in';
        $input['so_from'] = $supply->so_number;
        $input['shift'] = $request->input('shift');
        $stock = Stock::create($input);
        $stock->product()->associate($product->first()->id);
        $stock->save();

        $trip_delivered = $supply_item->first()->trip_delivered + 1;
        if($trip_delivered==$supply_item->first()->trip){
            $supply_item->first()->update([
                'trip_delivered' => $trip_delivered,
                'status' => 'Terkirim'
            ]);
        }else{
            $supply_item->first()->update([
                'trip_delivered' => $trip_delivered,
            ]);
        }

        return redirect()->route('stock.index')->with('success', 'Penebusan BBM telah ditambahkan ke stok BBM'); 
    }


    public function storeInitialStock(Request $request, $id){

        $this->validate($request, [
            'initial_stock' => 'required',
        ],
        [   
            'initial_stock.required'    => 'Stok awal tidak boleh kosong',
        ]);

        $product = Product::find($id);
        $now = Carbon::now();
        $input = $request->all();
        $input['stock_type'] = 'initial';
        $input['so_from'] = '-';
        $input['quantity'] = $request->input('initial_stock');
        $input['stock_date'] = $now;

        $stocks = $product->stocks()->updateOrCreate(
            [
                'stock_type' => 'initial'
            ],
            $input);

        return redirect()->route('stock.index')->with('success', 'Berhasil menyimpan data stock awal');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $product_stocks = $product->stocks;

        return view('stock.show', compact('product','product_stocks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
