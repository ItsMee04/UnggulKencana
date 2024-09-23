<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use App\Models\Jenis;
use App\Models\Nampan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProdukController extends Controller
{
    public function index()
    {
        $nampan = Nampan::where('status', 1)->get();
        return view('produk.produk', ['nampan' => $nampan]);
    }

    public function show($id)
    {
        $produk = Produk::where('nampan_id', $id)->get();

        $nampan = Nampan::where('id', $id)->first();
        $nampans = Nampan::where('id', $id)->get();

        $jenis_id = $nampan->first()->jenis_id;

        $jenis  = Jenis::where('id', $jenis_id)->first();

        $jeniss  = Jenis::where('id', $jenis_id)->get();

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 12;

        $code = '';

        while (strlen($code) < 12) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code . $character;
        }

        return view('produk.detail-produk', ['produk' => $produk, 'nampan' => $nampan, 'nampans' => $nampans, 'jenis' => $jenis, 'jeniss' => $jeniss, 'kodeproduk' => $code]);
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib di isi !!!',
        ];

        $credentials = $request->validate([
            'nama'          => 'required',
            'berat'         => 'required',
            'karat'         => 'required',
            'hargajual'     => 'required',
            'hargabeli'     => 'required',
            'keterangan'    => 'required',
            'status'        => 'required'
        ], $messages);

        if ($request->status == 'Pilih Status') {
            return redirect('nampan')->with('errors-message', 'Status wajib di isi !!!');
        }

        $image = "";
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = $request->kodeproduk . '.' . $extension;
            $request->file('image')->storeAs('Image', $image);
            $request['image'] = $image;
        }

        Produk::create([
            'kodeproduk'        =>  $request->kodeproduk,
            'jenis_id'          =>  $request->jenis,
            'nampan_id'         =>  $request->nampan,
            'nama'              =>  $request->nama,
            'harga_jual'        =>  $request->hargajual,
            'harga_beli'        =>  $request->hargabeli,
            'keterangan'        =>  $request->keterangan,
            'berat'             =>  $request->berat,
            'karat'             =>  $request->karat,
            'image'             =>  $image,
            'status'            =>  $request->status
        ]);

        return redirect('produk/' . $request->nampan)->with('success-message', 'Data Success Disimpan !');
    }
}
