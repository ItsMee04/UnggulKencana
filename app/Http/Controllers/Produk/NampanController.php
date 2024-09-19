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
            'jenis'         => 'required',
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

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute wajib di isi !!!',
        ];

        $credentials = $request->validate([
            'jenis'         => 'required',
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

        $updateNampan = Nampan::where('id', $id)
            ->update([
                'jenis_id'  =>  $request->jenis,
                'nampan'    =>  $request->nampan,
                'tanggal'   =>  $request->tanggal,
                'status'    =>  $request->status,
            ]);

        return redirect('nampan')->with('success-message', 'Data Success Diupdate !');
    }

    public function delete($id)
    {
        Nampan::where('id', $id)->delete();

        return redirect('nampan')->with('success-message', 'Data Success Dihapus !');
    }
}
