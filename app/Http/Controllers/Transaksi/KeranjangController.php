<?php

namespace App\Http\Controllers\Transaksi;

use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
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

        if ($credentials) {
            Keranjang::create([
                'keranjang_id'  =>  $code,
                'produk_id'     =>  $id,
                'total'         =>  $total,
                'users'         =>  Auth::user()->id,
                'status'        =>  1,
            ]);
        }

        return response()->json([
            'message' => 'Item berhasil disimpan',
        ]);
    }
}
