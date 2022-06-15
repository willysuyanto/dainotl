<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nozzle;
use App\Models\Product;

class NozzleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nozzles = Nozzle::all();

        return view('nozzle.index', compact('nozzles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('nozzle.create', compact('products'));
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
            'group' => 'required',
            'product' => 'required'
        ],
        [
            'group.required' => 'Pilih grup terlebih dahulu',
            'product.required' => 'Pilih Jenis BBM terlebih dahulu'
        ]
        );

        $input = $request->all();
        $product = Product::find($request->input('product'));

        $product->nozzles()->create($input);
        
        return redirect()->route('nozzle.index')->with('success', 'Berhasil Menambahkan Nozzle');

        // return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nozzle = Nozzle::find($id);
        $products = Product::all();
        return view('nozzle.edit', compact('nozzle', 'products'));
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
        $this->validate($request, [
            'group' => 'required',
            'product' => 'required',
            'last_totalizer' => 'required'
        ],
        [
            'group.required' => 'Pilih grup terlebih dahulu',
            'product.required' => 'Pilih Jenis BBM terlebih dahulu',
            'last_totalizer.required' => 'Nilai totalizer terakhir tidak boleh kosong'
        ]
        );

        $product = Product::find($request->input('product'));
        
        $input = ['group'=> $request->input('group'), 'last_totalizer' => $request->input('last_totalizer')];
        
        $product->nozzles()->where('id', $id)->update($input);
        
        return redirect()->route('nozzle.index')->with('success', 'Berhasil mengubah data Nozzle');

        //return $input;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_item = Nozzle::find($id);
        $deleted_item->delete();
        $message = "Nozzle dengan id".$deleted_item->id." telah dihapus";
        return $message;
    }
}
