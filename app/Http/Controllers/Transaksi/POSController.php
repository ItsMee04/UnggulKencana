<?php

namespace App\Http\Controllers\Transaksi;

use App\Models\Jenis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produk;

class POSController extends Controller
{
    public function index()
    {
        $jenis = Jenis::where('status', 1)->get();
        $produk = Produk::where('status', 1)->get();

        return view('transaksi.pos', [
            'jenis' => $jenis,
            'produk' => $produk
        ]);
    }
}
