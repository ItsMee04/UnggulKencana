<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib di isi !!!',
        ];

        $credentials = $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ], $messages);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->status != 1) {
                return redirect('login')->with('errors-message', 'User Account Belum Aktif !');
            } else {
                if (Auth::user()->role_id == 1) {
                    $employee = Pegawai::where('id', Auth::user()->pegawai_id)->first()->nama;
                    $avatar   = Pegawai::where('id', Auth::user()->pegawai_id)->first()->avatar;

                    $idprofession   = Pegawai::where('id', Auth::user()->pegawai_id)->first()->jabatan_id;
                    $jabatan     = Jabatan::where('id', $idprofession)->first()->jabatan;

                    $role   = Role::where('id', Auth::user()->role_id)->first()->role;

                    Session::put('name', $employee);
                    Session::put('avatar', $avatar);
                    Session::put('profession', $jabatan);
                    Session::put('role', $role);

                    return redirect('dashboard')->with('success-message', 'Login Berhasil');
                }
            }
        }

        return redirect('login')->with('errors-message', 'username atau password salah !');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        //mengarahkan ke halaman login
        return redirect('login')->with('success-message', 'Logout Berhasil');
    }
}
