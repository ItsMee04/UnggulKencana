<?php

namespace App\Http\Controllers\Transaksi;

use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $produk = DB::table('produk')
            ->leftJoin('keranjang', 'produk.id', '=', 'keranjang.produk_id')
            ->select('produk.*', 'keranjang.id as idkeranjang', 'keranjang.keranjang_id', 'keranjang.status', 'keranjang.users')
            ->where('keranjang.status', 1)
            ->where('keranjang.users', Auth::user()->id)
            ->get();

        return response()->json($produk);
    }

    public function getCount()
    {
        $count = Keranjang::where('status', 1)->where('users', Auth::user()->id)->count();

        return response()->json(['success' => true, 'count' => $count]);
    }

    public function cekItem(Request $request, $id)
    {
        $item = Keranjang::where('produk_id', $request->id)->where('status', 1)->first();

        if ($item) {
            return response()->json(['status' => 'error', 'message' => 'Data sudah ada di database!'], 400);
        } else {
            return response()->json(['status' => 'success', 'message' => 'Data belum ada, lanjutkan proses simpan']);
        }
    }

    public function saveItem(Request $request, $id)
    {
        $messages = [
            'required'  => ':attribute wajib di isi !!!',
        ];

        $credentials = $request->validate([
            'id'            => 'required',
        ], $messages);

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 12;

        $code = '';

        while (strlen($code) < $codeLength) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code . $character;
        }

        $total = Produk::where('id', $id)->first()->harga_jual;

        $produk = Keranjang::where('produk_id', $id)->first();

        $keranjangID = Keranjang::latest('keranjang_id')->first();

        if ($credentials) {

            if ($keranjangID == null) {
                Keranjang::create([
                    'keranjang_id'  =>  $code,
                    'produk_id'     =>  $id,
                    'total'         =>  $total,
                    'status'        =>  1,
                    'users'         =>  Auth::user()->id,
                ]);
            } elseif ($keranjangID->status == 1) {

                Keranjang::create([
                    'keranjang_id'  =>  $keranjangID->keranjang_id,
                    'produk_id'     =>  $id,
                    'total'         =>  $total,
                    'status'        =>  1,
                    'users'         =>  Auth::user()->id,
                ]);
            } elseif ($keranjangID->status == 2) {

                Keranjang::create([
                    'keranjang_id'  =>  $code,
                    'produk_id'     =>  $id,
                    'total'         =>  $total,
                    'status'        =>  1,
                    'users'         =>  Auth::user()->id,
                ]);
            }
        }

        return response()->json([
            'success-message' => 'Item berhasil disimpan',
            'data'            =>  $keranjangID
        ]);
    }

    public function deleteKeranjang($id)
    {
        $delete = Keranjang::where('id', $id)->delete();

        return response()->json(['data' => $delete, 'success' => true]);
    }

    public function deleteAllKeranjang()
    {
        Keranjang::where('status', 1)->where('users', Auth::user()->id)->delete();

        return response()->json(['success' => true]);
    }

    public function totalHargaKeranjang()
    {
        $total = Keranjang::leftjoin('produk', 'keranjang.produk_id', 'produk.id')
            ->select('produk.harga_jual')
            ->where('keranjang.status', 1)
            ->where('keranjang.users', Auth::user()->id)
            ->sum(DB::raw('produk.harga_jual'));

        return response()->json(['success' => true, 'total' => $total]);
    }

    public function getKodeKeranjang()
    {
        $keranjang = Keranjang::where('status', 1)->where('users', Auth::user()->id)->first()->keranjang_id;

        $produkID = Keranjang::select('produk_id')->where('keranjang_id', $keranjang)->get();

        foreach ($produkID as $item) {
            $item['produk_id'];
        }

        return response()->json(['success' => true, 'kode' => $keranjang, 'produk_id' => $produkID]);
    }

    public function payment(Request $request)
    {
        $produk = $request->produkID;

        $payment = Transaksi::create([
            'transaksi_id'  =>  $request->transaksiID,
            'id_keranjang'  =>  $request->kodeKeranjangID,
            'pelanggan_id'  =>  $request->pelangganID,
            'diskon'        =>  $request->diskonID,
            'tanggal'       =>  Carbon::today()->format('Y-m-d'),
            'total'         =>  $request->total,
            'users_id'      =>  Auth::user()->id,
            'status'        =>  1,
        ]);

        if ($payment) {
            Keranjang::where('status', 1)
                ->where('users', Auth::user()->id)
                ->where('keranjang_id', $request->kodeKeranjangID)
                ->update([
                    'status' => 2,
                ]);

            foreach ($produk as $value) {
                Produk::where('id', $value)
                    ->update([
                        'status' => 2,
                    ]);
            }
        }

        return response()->json(['success' => true, 'Transaksi Berhasil']);
    }
}
