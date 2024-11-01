<?php

namespace App\Http\Controllers\stok;

use App\Models\Nampan;
use App\Models\nampanProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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

        $nampan = DB::table('nampan_produk')
            ->select(
                'nampan_produk.nampan_id',
                'nampan.nampan',
                DB::raw('COUNT(produk_id) as total_produk'),
                DB::raw('SUM(produk.berat) as total_berat')
            )
            ->join('nampan', 'nampan_produk.nampan_id', 'nampan.id')
            ->join('produk', 'nampan_produk.produk_id', 'produk.id')
            ->whereBetween('tanggal', [$tglDari, $tglSampai])
            ->groupBy('nampan_produk.nampan_id')
            ->get();

        return response()->json([
            'success'   =>  true,
            'message'   =>  'Data Ditemukan',
            'Data'      =>  $nampan
        ]);
    }
}
