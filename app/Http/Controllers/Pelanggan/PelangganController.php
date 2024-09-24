<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::where('status', 1)->get();

        $nomorpelanggan = Pelanggan::latest()->first();
        $kode = "CUST#-";
        $tahun = date('Y');

        if ($nomorpelanggan == null) {
            $serialnumber = "000001";
            $kodepelanggan = $kode . $tahun . $serialnumber;
        } else {
            $serialnumber = substr($nomorpelanggan->kodepelanggan, 12, 12) + 1;
            $serialnumber = str_pad($serialnumber, 6, "0", STR_PAD_LEFT);

            $kodepelanggan = $kode . $tahun . $serialnumber;
        }

        return view('pelanggan.index', ['pelanggan' => $pelanggan, 'kodepelanggan' => $kodepelanggan]);
    }

    public function store(Request $request)
    {
        $messages = [
            'required'  => ':attribute wajib di isi !!!',
            'integer'   => ':attribute format wajib menggunakan angka',
            'numeric'   => ':attribute format wajib menggunakan angka',
        ];

        $credentials = $request->validate([
            'kodepelanggan'   => 'required',
            'nik'             => 'required|integer|numeric',
            'nama'            => 'required',
            'alamat'          => 'required',
            'kontak'          => 'required|numeric',
            'tanggal'         => 'required',
            'status'          => 'required',
        ], $messages);

        if ($request->status == 'Pilih Status') {
            return redirect('pelanggan')->with('errors-message', 'Status wajib di isi !!!');
        }

        Pelanggan::create([
            'kodepelanggan' =>  $request->kodepelanggan,
            'nik'           =>  $request->nik,
            'nama'          =>  $request->nama,
            'alamat'        =>  $request->alamat,
            'kontak'        =>  $request->kontak,
            'tanggal'       =>  $request->tanggal,
            'status'        =>  $request->status,
        ]);

        return redirect('pelanggan')->with('success-message', 'Data Success Disimpan !');
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required'  => ':attribute wajib di isi !!!',
            'integer'   => ':attribute format wajib menggunakan angka',
            'numeric'   => ':attribute format wajib menggunakan angka',
        ];

        $credentials = $request->validate([
            'nik'             => 'required|integer|numeric',
            'nama'            => 'required',
            'alamat'          => 'required',
            'kontak'          => 'required|numeric',
            'tanggal'         => 'required',
            'status'          => 'required',
        ], $messages);

        if ($request->status == 'Pilih Status') {
            return redirect('pelanggan')->with('errors-message', 'Status wajib di isi !!!');
        }

        Pelanggan::where('id', $id)
            ->update([
                'nik'           =>  $request->nik,
                'nama'          =>  $request->nama,
                'alamat'        =>  $request->alamat,
                'kontak'        =>  $request->kontak,
                'tanggal'       =>  $request->tanggal,
                'status'        =>  $request->status,
            ]);

        return redirect('pelanggan')->with('success-message', 'Data Success Di Update !');
    }

    public function delete($id)
    {
        Pelanggan::where('id', $id)->update([
            'status'    =>  2,
        ]);

        return redirect('pelanggan')->with('success-message', 'Data Success Di Hapus !');
    }
}
