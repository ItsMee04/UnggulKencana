<?php

namespace App\Http\Controllers\stok;

use App\Http\Controllers\Controller;
use App\Models\Nampan;
use App\Models\nampanProduk;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        return view('stok.stok');
    }

    public function cekstok(Request $request)
    {
        $tglDari = $request->tglDari;
        $tglSampai = $request->tglSampai;

        $nampan = nampanProduk::whereBetween('tanggal', [$tglDari, $tglSampai])->get();

        return response()->json([
            'success'   =>  true,
            'message'   =>  'Data Ditemukan',
            'Data'      =>  $nampan->loadMissing('produk')->loadMissing('nampan')
        ]);
    }
}
