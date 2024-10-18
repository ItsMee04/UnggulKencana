<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $order = Transaksi::all();

        return view('Transaksi.order', ['order' => $order]);
    }

    public function detailOrder($id)
    {
        $transaksi      = Transaksi::where('transaksi_id', $id)->first();

        $keranjang      = Keranjang::where('keranjang_id', $transaksi->id_keranjang)->get();
        $subtotal       = Keranjang::where('keranjang_id', $transaksi->id_keranjang)->sum('total');

        return view('transaksi.detail-order', compact(
            'transaksi',
            'keranjang',
            'subtotal',
        ));
    }
    public function confirmPayment($id)
    {
        Transaksi::where('id', $id)
            ->update([
                'status'    => 2,
            ]);

        return redirect('order')->with('success-message', 'Pembayaran Berhasil');
    }
}
