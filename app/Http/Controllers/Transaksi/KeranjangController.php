<?php

namespace App\Http\Controllers\Transaksi;

use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        $item = Keranjang::where('produk_id', $request->id)->first();

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

        if ($credentials) {
            if (DB::table('keranjang')->where('produk_id', $id)->exists()) {
                return redirect('pos')->with('errors-message', 'Data Produk Sudah Ada !');
            } else {
                Keranjang::create([
                    'keranjang_id'  =>  $code,
                    'produk_id'     =>  $id,
                    'total'         =>  $total,
                    'users'         =>  Auth::user()->id,
                    'status'        =>  1,
                ]);
            }
        }

        return response()->json([
            'success-message' => 'Item berhasil disimpan',
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
}
