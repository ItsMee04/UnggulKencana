<?php

namespace App\Http\Controllers\Report;

use PHPJasper\PHPJasper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function cetakNotaBarang()
    {
        // Path ke file .jrxml atau .jasper
        $input = resource_path('resources/report/NotaBarang.jasper');

        // Path output untuk menyimpan hasil laporan
        $output = storage_path('app/reports/your_report_output');

        // Parameter untuk report (jika ada)
        $parameters = [
            'param1' => 'value1', // Sesuaikan dengan parameter yang ada di report
            // 'param2' => 'value2',
        ];

        // Konfigurasi koneksi database (sesuaikan dengan database yang Anda gunakan)
        $database = [
            'driver'   => 'mysql', // atau pgsql, sqlsrv, dll.
            'host'     => env('DB_HOST'),
            'port'     => env('DB_PORT'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'database' => env('DB_DATABASE'),
        ];

        // Buat instance PHPJasper
        $jasper = new PHPJasper;

        // Jalankan JasperReport dan tentukan output formatnya
        $jasper->process(
            $input,
            $output,
            ['pdf', 'xlsx'], // Output format: pdf, xls, xlsx, html, csv, dll.
            $parameters,
            $database
        )->execute();

        // Download atau tampilkan file hasil report
        return response()->file($output . '.pdf');
    }
}
