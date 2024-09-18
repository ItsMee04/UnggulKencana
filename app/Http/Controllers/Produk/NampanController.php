<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use App\Models\Jenis;
use App\Models\Nampan;
use Illuminate\Http\Request;

class NampanController extends Controller
{
    public function index()
    {
        $nampan = Nampan::all();
        $jenis  = Jenis::all();

        return view('produk.nampan', ['nampan' => $nampan, 'jenis' => $jenis]);
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib di isi !!!',
        ];

        $credentials = $request->validate([
            'nampan'        => 'required',
            'tanggal'       => 'required',
            'status'        => 'required'
        ], $messages);

        if ($request->jenis == 'Pilih Jenis Produk') {
            return redirect('nampan')->with('errors-message', 'Jenis wajib di isi !!!');
        }

        if ($request->status == 'Pilih Status') {
            return redirect('nampan')->with('errors-message', 'Status wajib di isi !!!');
        }

        $storeNampan = Nampan::create([
            'jenis_id'  =>  $request->jenis,
            'nampan'    =>  $request->nampan,
            'tanggal'   =>  $request->tanggal,
            'status'    =>  $request->status
        ]);

        return redirect('nampan')->with('success-message', 'Data Success Disimpan !');
    }
}
