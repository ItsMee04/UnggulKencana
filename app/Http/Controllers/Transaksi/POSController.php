<?php

namespace App\Http\Controllers\Transaksi;

use App\Models\Jenis;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class POSController extends Controller
{
    public function index()
    {
        $jenis = Jenis::where('status', 1)->get();
        $produk = Produk::where('status', 1)->get();

        $jenisProduk = DB::table('produk')
            ->select('jenis_id')
            ->where('status', 1)
            ->groupBy('jenis_id')
            ->get();

        return view('transaksi.pos', compact(
            'jenis',
            'produk',
            'jenisProduk'
        ));
    }
}
