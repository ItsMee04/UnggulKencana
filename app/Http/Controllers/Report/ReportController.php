<?php

namespace App\Http\Controllers\Report;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produk;

class ReportController extends Controller
{
    public function cetakNotaBarang($id)
    {
        $Produk = Produk::where('id', $id)->first();

        $data = [
            'kodeproduk' => $Produk->kodeproduk
        ];

        // Menggunakan view untuk menghasilkan HTML
        $pdf = PDF::loadView('report.notaBarang', $data);

        $pdf->setPaper('A5', 'landscape'); // Ganti 'A4' dan 'landscape' sesuai kebutuhan

        // Mengatur untuk stream PDF
        return $pdf->stream('notabarang.pdf');
    }
}
