<?php

namespace App\Http\Controllers\Transaksi;

use App\Models\Jenis;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Diskon;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class POSController extends Controller
{
    public function index()
    {
        $jenis = Jenis::where('status', 1)->get();
        $produk = Produk::where('status', 1)->get();
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

        $id = "T-";
        $tahun = date('Y');

        $idTransaction = Transaksi::latest()->first();

        $keranjang = Keranjang::where('status', 1)->where('users', Auth::user()->id)->get();

        if ($idTransaction == null) {
            $nourut = "000001";
            $idtransaksi = $id . $tahun . $nourut;
        } else {
            $nourut = substr($idTransaction->transaksi_id, 6, 6) + 1;
            $nourut = str_pad($nourut, 6, "0", STR_PAD_LEFT);

            $idtransaksi = $id . $tahun . $nourut;
        }

        $diskon = Diskon::where('status', 1)->get();

        $jenisProduk = DB::table('produk')
            ->select('jenis_id')
            ->where('status', 1)
            ->groupBy('jenis_id')
            ->get();

        return view('transaksi.pos', [
            'jenis'         =>  $jenis,
            'produk'        =>  $produk,
            'jenisProduk'   =>  $jenisProduk,
            'pelanggan'     =>  $pelanggan,
            'kodepelanggan' =>  $kodepelanggan,
            'kodetransaksi' =>  $idtransaksi,
            'keranjang'     =>  $keranjang,
            'diskon'        =>  $diskon,
        ]);
    }

    public function fetchAllItem()
    {
        $produk = Produk::where('status', 1)->get();

        foreach ($produk as $item) {
            $item['harga_jual'] = number_format($item['harga_jual'], 0, ',', '.');
        }
        return $produk->loadMissing('jenis');
    }

    public function getItem($id)
    {
        if ($id == 'all') {
            $produk = Produk::where('status', 1)->get();
            return $produk->loadMissing('jenis');
        } else {
            $produk = Produk::where('jenis_id', $id)->get();

            return $produk->loadMissing('jenis');
        }
    }
}
