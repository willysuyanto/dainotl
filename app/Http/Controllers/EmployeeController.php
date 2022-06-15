<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function getPosition(){
        $positions = ['Staff', 'Manager', 'Lainnya'];

        return $positions;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = self::getPosition();
        return view('employee.create', compact('positions'));
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
            'full_name'=>'required',
            'employee_number'=>'required|unique:employees,employee_number',
            'position'=>'required',
            'working_since'=>'required',
        ],
        [
            'product_name.required' => 'Kolom nama lengkap tidak boleh kosong',
            'employee_number.required' => 'Kolom nomor karyawan tidak boleh kosong',
            'employee_number.unique' => 'Nomor karyawan sudah digunakan',
            'position.required' => 'Kolom jabatan tidak boleh kosong',
            'working_since.required' => 'Harap mengisi tanggal mulai bekerja karyawan',
           
        ]);

        $positions = self::getPosition();   
        $selected_position = $positions[$request->input('position')];
        $input = $request->all();
        $input['position'] = $selected_position;
        $input['working_since'] = Carbon::createFromFormat("d/m/Y", $request->input('working_since'));
        Employee::create($input);

        return redirect()->route('employee.index')->with('success', 'Berhasil menambahkan pegawai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $positions = self::getPosition();
        $selected_position = array_search($employee->position, $positions);
        return view('employee.edit', compact('employee', 'positions', 'selected_position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $this->validate($request, [
            'full_name'=>'required',
            'employee_number'=>'required|unique:employees,employee_number,'.$employee->id,
            'position'=>'required',
            'working_since'=>'required',
        ],
        [
            'product_name.required' => 'Kolom nama lengkap tidak boleh kosong',
            'employee_number.required' => 'Kolom nomor karyawan tidak boleh kosong',
            'employee_number.unique' => 'Nomor karyawan sudah digunakan',
            'position.required' => 'Kolom jabatan tidak boleh kosong',
            'working_since.required' => 'Harap mengisi tanggal mulai bekerja karyawan',
           
        ]);

        $positions = self::getPosition();   
        $selected_position = $positions[$request->input('position')];
        $input = $request->all();
        $input['position'] = $selected_position;
        $input['working_since'] = Carbon::createFromFormat("d/m/Y", $request->input('working_since'));
        $employee->update($input);

        return redirect()->route('employee.index')->with('success', 'Berhasil menyimpan perubahan data pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_item = Employee::find($id);
        $deleted_item->delete();
        $message = $deleted_item->full_name." telah dihapus";
        return $message;
    }
}
