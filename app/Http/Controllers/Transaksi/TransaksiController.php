<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Produk;
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

    public function cancelPayment($id)
    {
        $transaksi      = Transaksi::where('id', $id)->get();
        $idKeranjang    = Transaksi::where('id', $id)->first()->id_keranjang;
        $idproduk       = Keranjang::where('keranjang_id', $idKeranjang)->get();

        $produkIds = Keranjang::where('keranjang_id', $idKeranjang)->pluck('produk_id');

        $cancelPayment = Transaksi::where('id', $id)->update([
            'status'    =>  0,
        ]);

        if ($cancelPayment) {
            Produk::whereIn('id', $produkIds)
                ->update([
                    'status' => 1
                ]);

            $keranjang = Keranjang::where('keranjang_id', $idKeranjang)->update([
                'status'    => 0,
            ]);
        }

        return response()->json([
            'success'   =>  true,
            'message'   =>  "Transaksi Dibatalkan",
            'Data'      =>  $transaksi
        ]);
    }
}
