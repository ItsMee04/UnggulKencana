<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Diskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    public function index()
    {
        $diskon = Diskon::all();

        return view('transaksi.diskon', ['diskon' => $diskon]);
    }

    public function store(Request $request)
    {
        $messages = [
            'required'  => ':attribute wajib di isi !!!',
            'integer'   => ':attribute format wajib menggunakan angka',
            'numeric'   => ':attribute format wajib menggunakan angka',
        ];

        $credentials = $request->validate([
            'nama'            => 'required',
            'diskon'          => 'required|integer|numeric',
            'status'          => 'required',
        ], $messages);

        if ($request->status == 'Pilih Status') {
            return redirect('diskon')->with('errors-message', 'Status wajib di isi !!!');
        }

        Diskon::create([
            'nama'      =>  $request->nama,
            'diskon'    =>  $request->diskon,
            'status'    =>  $request->status,
        ]);

        return redirect('diskon')->with('success-message', 'Data Success Disimpan !');
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required'  => ':attribute wajib di isi !!!',
            'integer'   => ':attribute format wajib menggunakan angka',
            'numeric'   => ':attribute format wajib menggunakan angka',
        ];

        $credentials = $request->validate([
            'nama'            => 'required',
            'diskon'          => 'required|integer|numeric',
            'status'          => 'required',
        ], $messages);

        if ($request->status == 'Pilih Status') {
            return redirect('diskon')->with('errors-message', 'Status wajib di isi !!!');
        }

        Diskon::where('id', $id)
            ->update([
                'nama'      =>  $request->nama,
                'diskon'    =>  $request->diskon,
                'status'    =>  $request->status,
            ]);

        return redirect('diskon')->with('success-message', 'Data Success Di Update !');
    }

    public function delete($id)
    {
        Diskon::where('id', $id)->delete();

        return redirect('diskon')->with('success-message', 'Data Success Di Hapus !');
    }
}
