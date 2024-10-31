<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function index()
    {
        return view('produk.scanbarcode');
    }

    public function scanqr(Request $request)
    {
        $id = $request->qr_code;
        $qrcodeid = Produk::where('kodeproduk', $id)->first()->id;

        if ($id == $qrcodeid) {
            return response()->json([
                'status' => 200,
                'produk' => $qrcodeid
            ]);
        } else {
            return response()->json(
                [
                    'status' => 400,
                    'produk tidak ditemukan'
                ]
            );
        }
    }
}
