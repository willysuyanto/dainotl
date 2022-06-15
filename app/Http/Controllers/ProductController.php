<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
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
            'product_name'=>'required|unique:products,product_name',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'quantity_per_trip' => 'required', 
            'color' => 'required|unique:products,color',
        ],
        [
            'product_name.required' => 'Kolom nama produk tidak boleh kosong',
            'product_name.unique' => 'Nama :product_name sudah digunakan, pilih nama lain.',
            'purchase_price.required' => 'Kolom harga beli tidak boleh kosong',
            'selling_price.required' => 'Kolom harga jual tidak boleh kosong',
            'quantity_per_trip.required' => 'Kolom trip quantity tidak boleh kosong',
            'color.required' => 'Pilih warna kolom terlebih dahulu',
            'color.unique' => 'Warna kolom sudah digunakan, pilih warna lain.',
        ]);

        $input = $request->all();
        Product::create($input);
        return redirect()->route('product.index')->with('success', 'Berhasil menambahkan produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_name'=>'required|unique:products,product_name,'.$id,
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'quantity_per_trip' => 'required',
            'color' => 'required',
        ],
        [
            'product_name.required' => 'Kolom nama produk tidak boleh kosong',
            'product_name.unique' => 'Nama produk :product_name sudah digunakan, pilih nama lain.',
            'purchase_price.required' => 'Kolom harga beli tidak boleh kosong',
            'selling_price.required' => 'Kolom harga jual tidak boleh kosong',
            'quantity_per_trip.required' => 'Kolom trip quantity tidak boleh kosong',
            'color.required' => 'Pilih warna kolom terlebih dahulu',
            'color.unique' => 'Warna kolom sudah digunakan, pilih warna lain.',
        ]);

        $input = $request->all();
        $data = Product::find($id);
        $data->update($input);

        return redirect()->route('product.index')->with('success','Berhasil menyimpan perubahan data produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_item = Product::find($id);
        $deleted_item->delete();
        $message = $deleted_item->product_name." telah dihapus";
        return $message;
    }
}
