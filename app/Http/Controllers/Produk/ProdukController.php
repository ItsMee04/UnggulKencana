<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use App\Models\Jenis;
use App\Models\Nampan;
use App\Models\Produk;
use Illuminate\Http\Request;

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

        $jenis_id = $nampan->first()->jenis_id;

        $jenis  = Jenis::where('id', $jenis_id)->first();

        $jeniss  = Jenis::where('id', $jenis_id)->get();


        return view('produk.detail-produk', ['produk' => $produk, 'nampan' => $nampan, 'jenis' => $jenis, 'jeniss' => $jeniss]);
    }
}
