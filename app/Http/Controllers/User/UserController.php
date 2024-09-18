<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('role_id', '!=', 1)->get();

        return view('user.index', ['user' => $user]);
    }

    public function store(Request $request, $id)
    {

        $messages = [
            'required' => ':attribute wajib di isi !!!',
            'unique'   => ':attribute sudah digunakan'
        ];

        $credentials = $request->validate([
            'email'     => 'required|unique:users',
            'password'  => 'required',
        ], $messages);

        User::where('pegawai_id', $id)
            ->update([
                'email' =>  $request->email,
                'password'  =>  Hash::make($request->password)
            ]);

        return redirect('user')->with('success-message', 'Data Success Di Simpan !');
    }
}
