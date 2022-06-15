<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function edit(){
        return view('auth.change-password');
    }

    public function update(Request $request){
        $request->validate([
            'password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'min:8'],
            'confirm_new_password' => ['same:new_password'],
        ],
        [
            'password.required' => 'Kolom password lama tidak boleh kosong',
            'new_password.required' => 'Kolom password baru tidak boleh kosong',
            'new_password.min' => 'Password baru harus minimal 8 karakter',
            'confirm_new_password.required' => 'Kolom konfirmasi password baru tidak boleh kosong',
            'confirm_new_password.same' => 'Password baru dan konfirmasi password baru tidak cocok',
        ]
    );
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect('dashboard')->with('success', 'Berhasil mengubah password');
    }
}
