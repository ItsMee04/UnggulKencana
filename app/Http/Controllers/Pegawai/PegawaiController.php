<?php

namespace App\Http\Controllers\Pegawai;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::where('jabatan_id', '!=', 1)->get();
        $jabatan = Jabatan::where('id', '!=', 1)->get();

        return view('pegawai.index', ['pegawai' => $pegawai, 'jabatan' => $jabatan]);
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib di isi !!!',
            'mimes'    => ':attribute format wajib menggunakan PNG/JPG',
            'unique'   => ':attribute sudah digunakan'
        ];

        $credentials = $request->validate([
            'nip'           =>  'required|unique:pegawai',
            'nama'          => 'required',
            'kontak'        => 'required',
            'jabatan'       => 'required',
            'alamat'        => 'required',
            'status'        => 'required',
            'avatar'        => 'mimes:png,jpg,jpeg',
        ], $messages);

        if ($request->jabatan == 'Pilih Jabatan') {
            return redirect('pegawai')->with('errors-message', 'Jabatan Harus Di Pilih');
        } elseif ($request->status == 'Pilih Status') {
            return redirect('pegawai')->with('errors-message', 'Status Harus Di Pilih');
        }

        $newAvatar = '';

        if ($request->file('avatar')) {
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $newAvatar = $request->nip . '.' . $extension;
            $request->file('avatar')->storeAs('Avatar', $newAvatar);
            $request['avatar'] = $newAvatar;
        }

        $store = Pegawai::create([
            'nip'           => $request->nip,
            'nama'          => $request->nama,
            'alamat'        => $request->alamat,
            'kontak'        => $request->kontak,
            'jabatan_id'    => $request->jabatan,
            'status'        => $request->status,
            'avatar'        => $newAvatar,
        ]);

        $pegawai_id = Pegawai::where('nip', '=', $request->nip)->first()->id;

        if ($store) {
            User::create([
                'pegawai_id' => $pegawai_id,
                'role_id'    => $request->jabatan,
                'status'     => $request->status
            ]);
        }

        return redirect('pegawai')->with('success-message', 'Data Success Di Simpan !');
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::where('id', $id)->first();

        $messages = [
            'required' => ':attribute wajib di isi !!!',
            'mimes'    => ':attribute format wajib menggunakan PNG/JPG'
        ];

        $credentials = $request->validate([
            'nama'          => 'required',
            'kontak'        => 'required',
            'jabatan'       => 'required',
            'alamat'        => 'required',
            'status'        => 'required',
            'avatar'        => 'mimes:png,jpg,jpeg',
        ], $messages);

        if ($request->jabatan == 'Pilih Jabatan') {
            return redirect('pegawai')->with('errors-message', 'Jabatan Harus Di Pilih');
        } elseif ($request->status == 'Pilih Status') {
            return redirect('pegawai')->with('errors-message', 'Status Harus Di Pilih');
        }

        if ($request->file('avatar')) {
            $pathavatar     = 'storage/Avatar/' . $pegawai->avatar;

            if (File::exists($pathavatar)) {
                File::delete($pathavatar);
            }

            $extension = $request->file('avatar')->getClientOriginalExtension();
            $newAvatar = $request->nip . '.' . $extension;
            $request->file('avatar')->storeAs('Avatar', $newAvatar);
            $request['avatar'] = $newAvatar;

            $updarepegawai = Pegawai::where('id', $id)
                ->update([
                    'nama'          => $request->nama,
                    'alamat'        => $request->alamat,
                    'kontak'        => $request->kontak,
                    'jabatan_id'    => $request->jabatan,
                    'status'        => $request->status,
                    'avatar'        => $newAvatar,
                ]);

            if ($updarepegawai) {
                User::where('pegawai_id', $id)
                    ->update([
                        'role_id'   =>  $request->jabatan,
                        'status'    =>  $request->status
                    ]);
            }
        } else {
            $updarepegawai = Pegawai::where('id', $id)
                ->update([
                    'nama'          => $request->nama,
                    'alamat'        => $request->alamat,
                    'kontak'        => $request->kontak,
                    'jabatan_id'    => $request->jabatan,
                    'status'        => $request->status
                ]);

            if ($updarepegawai) {
                User::where('pegawai_id', $id)
                    ->update([
                        'role_id'   =>  $request->jabatan,
                        'status'    =>  $request->status
                    ]);
            }
        }
        return redirect('pegawai')->with('success-message', 'Data Success Di Update !');
    }

    public function delete($id)
    {
        $pegawai = Pegawai::where('id', $id)->first();
        $user    = User::where('pegawai_id', $id)->first();

        $path1 = 'storage/avatar/' . $pegawai->avatar;

        if (File::exists($path1)) {
            File::delete($path1);
        }

        $hapuspegawai = Pegawai::where('id', $id)->delete();

        if ($user != null) {
            if ($hapuspegawai) {
                User::where('pegawai_id', $id)->delete();
            }
        }

        return redirect('pegawai')->with('success-message', 'Data Success Dihapus !');
    }
}
