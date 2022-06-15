<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
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
            'name' => 'required',
        ],
        [
            'name.required' => 'Nama customer tidak boleh kosong'
        ]);

        $input = $request->all();
        if ($input['initial_credit'] == null){
            $input['initial_credit'] = 0;
        }
         Customer::create($input);

         return redirect()->route('customer.index')->with('success', 'Berhasil menambahkan data pelanggan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customer.edit', compact('customer'));
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
            'name' => 'required',
        ],
        [
            'name.required' => 'Nama customer tidak boleh kosong'
        ]);

        $input = $request->all();
        if ($input['initial_credit'] == null){
            $input['initial_credit'] = 0;
        }
        $customer = Customer::find($id);
        $customer->update($input);

        return redirect()->route('customer.index')->with('success', 'Berhasil mengubah data pelanggan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_item = Customer::find($id);
        $deleted_item->delete();
        $message = $deleted_item->name." telah dihapus";
        return $message;
    }
}
