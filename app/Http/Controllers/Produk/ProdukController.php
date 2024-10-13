<?php

namespace App\Http\Controllers\Produk;

use App\Models\Jenis;
use App\Models\Nampan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();

        $jenis  = Jenis::all();

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 12;

        $code = '';

        while (strlen($code) < 12) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code . $character;
        }

        return view('produk.produk', ['produk' => $produk, 'jenis' => $jenis, 'kodeproduk' => $code]);
    }

    public function show($id)
    {
        $produk = Produk::where('nampan_id', $id)->get();

        $nampan = Nampan::where('id', $id)->first();
        $nampans = Nampan::where('id', $id)->get();

        $jenis_id = $nampan->jenis_id;

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
            'mimes'    => ':attribute format wajib menggunakan PNG/JPG'
        ];

        $credentials = $request->validate([
            'nama'          => 'required',
            'berat'         => 'required',
            'karat'         => 'required',
            'hargajual'     => 'required',
            'hargabeli'     => 'required',
            'keterangan'    => 'required',
            'jenis'         => 'required',
            'image'         => 'mimes:png,jpg,jpeg',
            'status'        => 'required'
        ], $messages);

        if ($request->status == 'Pilih Status') {
            return redirect('produk')->with('errors-message', 'Status wajib di isi !!!');
        }

        if ($request->jenis == 'Pilih Jenis') {
            return redirect('produk')->with('errors-message', 'Status Jenis di isi !!!');
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

    public function update(Request $request, $id)
    {
        $produk = Produk::where('id', $id)->first();

        $messages = [
            'required' => ':attribute wajib di isi !!!',
            'mimes'    => ':attribute format wajib menggunakan PNG/JPG'
        ];

        $credentials = $request->validate([
            'nama'          => 'required',
            'berat'         => 'required',
            'karat'         => 'required',
            'hargajual'     => 'required',
            'hargabeli'     => 'required',
            'keterangan'    => 'required',
            'image'         => 'mimes:png,jpg,jpeg',
            'status'        => 'required'
        ], $messages);

        if ($request->status == 'Pilih Status') {
            return redirect('produk')->with('errors-message', 'Status wajib di isi !!!');
        }

        if ($request->file('image')) {
            $pathavatar     = 'storage/Image/' . $produk->image;

            if (File::exists($pathavatar)) {
                File::delete($pathavatar);
            }

            $extension = $request->file('image')->getClientOriginalExtension();
            $newImage = $produk->kodeproduk . '.' . $extension;
            $request->file('image')->storeAs('Image', $newImage);
            $request['image'] = $newImage;

            $updateProduk = Produk::where('id', $id)
                ->update([
                    'nama'              =>  $request->nama,
                    'harga_jual'        =>  $request->hargajual,
                    'harga_beli'        =>  $request->hargabeli,
                    'keterangan'        =>  $request->keterangan,
                    'berat'             =>  $request->berat,
                    'karat'             =>  $request->karat,
                    'image'             =>  $newImage,
                    'status'            =>  $request->status
                ]);
        } else {
            $updateProduk = Produk::where('id', $id)
                ->update([
                    'nama'              =>  $request->nama,
                    'harga_jual'        =>  $request->hargajual,
                    'harga_beli'        =>  $request->hargabeli,
                    'keterangan'        =>  $request->keterangan,
                    'berat'             =>  $request->berat,
                    'karat'             =>  $request->karat,
                    'status'            =>  $request->status
                ]);
        }

        return redirect('produk/' . $produk->nampan_id)->with('success-message', 'Data Success Di Update !');
    }

    public function delete($id)
    {
        $produk = Produk::where('id', $id)->first();

        $path = 'storage/Image/' . $produk->image;

        if (File::exists($path)) {
            File::delete($path);
        }

        Produk::where('id', $id)->delete();

        return redirect('produk/' . $produk->nampan_id)->with('success-message', 'Data Success Dihapus !');
    }
}
