<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index () {
        $data = Auth::user();
        return view('profile.index', compact('data'));
    }

    public function edit(){
        $data = Auth::user();
        return view('profile.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'username'=> 'required|unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'phone_number' => 'required',
        ],
        [   
            'name.required'    => 'Kolom Nama Lengkap tidak boleh kosong',
            'username.required'      => 'Kolom Username tidak boleh kosong',
            'username.unique' => 'Username :username sudah digunakan, masukkan username lain',
            'phone_number.required' => 'Kolom Nomer Telepon tidak boleh kosong',
            'phone_number.unique' => 'Nomer Telepon :phone_number sudah digunakan, masukkan nomer lain',
            'email.required' => 'Kolom Email tidak boleh kosong',
            'email.unique' => 'Email :email sudah digunakan, masukkan email lain',
            'email.email' => 'Format Email tidak valid',
        ]);

        $input = $request->all();
        $user = User::find($id);
        $user->update($input);
    
        return redirect()->route('profile.index')->with('success','Berhasil menyimpan perubahan profil');
    }
}
