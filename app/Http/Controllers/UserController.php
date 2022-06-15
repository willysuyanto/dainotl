<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->except(Auth::id());
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
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
            'username'=> 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|unique:users,phone_number',
            'roles' => 'required'
        ],
        [   
            'name.required'    => 'Kolom Nama Lengkap tidak boleh kosong',
            'username.required'      => 'Kolom Username tidak boleh kosong',
            'username.unique'      => 'Username :username sudah digunakan',
            'phone_number.required' => 'Kolom Nomer Telepon tidak boleh kosong',
            'phone_number.unique'      => 'Nomer Telepon :phone_number sudah digunakan',
            'email.required' => 'Kolom Email tidak boleh kosong',
            'email.email' => 'Format Email tidak valid',
            'email.unique' => 'Alamat Email :email sudah digunakan',
            'roles.required'      => 'User Roles tidak boleh kosong',
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($request->input('phone_number'));
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','Berhasil menambahkan user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.show',compact('user','roles','userRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'username'=> 'required|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,username,'.$id,
            'phone_number' => 'required|unique:users,phone_number,'.$id,
            'roles' => 'required'
        ],
        [   
            'name.required'    => 'Kolom Nama Lengkap tidak boleh kosong',
            'username.required'      => 'Kolom Username tidak boleh kosong',
            'username.unique'      => 'Username sudah digunakan',
            'phone_number.required' => 'Kolom Nomer Telepon tidak boleh kosong',
            'phone_number.unique'      => 'Nomer Telepon sudah digunakan',
            'email.required' => 'Kolom Email tidak boleh kosong',
            'email.email' => 'Format Email tidak valid',
            'email.unique' => 'Alamat Email sudah digunakan',
            'roles.required'      => 'User Roles tidak boleh kosong',
        ]);

        $input = $request->all();
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')->with('success','Berhasil menyimpan perubahan data user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_user = User::find($id);
        $deleted_user->delete();
        $message = "User ".$deleted_user->name." telah dihapus";
        return $message;
    }

}
