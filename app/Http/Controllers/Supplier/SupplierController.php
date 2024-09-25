<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::where('status', 1)->get();

        $nomorSupplier = Supplier::latest()->first();
        $kode = "SUPP#-";
        $tahun = date('Y');

        if ($nomorSupplier == null) {
            $serialnumber = "000001";
            $kodesupplier = $kode . $tahun . $serialnumber;
        } else {
            $serialnumber = substr($nomorSupplier->kodesupplier, 12, 12) + 1;
            $serialnumber = str_pad($serialnumber, 6, "0", STR_PAD_LEFT);

            $kodesupplier = $kode . $tahun . $serialnumber;
        }

        return view('supplier.index', ['supplier' => $supplier, 'kodesupplier' => $kodesupplier]);
    }

    public function store(Request $request)
    {
        $messages = [
            'required'  => ':attribute wajib di isi !!!',
            'integer'   => ':attribute format wajib menggunakan angka',
            'numeric'   => ':attribute format wajib menggunakan angka',
        ];

        $credentials = $request->validate([
            'kodesupplier'    => 'required',
            'supplier'        => 'required',
            'alamat'          => 'required',
            'kontak'          => 'required|numeric',
            'status'          => 'required',
        ], $messages);

        if ($request->status == 'Pilih Status') {
            return redirect('supplier')->with('errors-message', 'Status wajib di isi !!!');
        }

        Supplier::create([
            'kodesupplier'  =>  $request->kodesupplier,
            'supplier'      =>  $request->supplier,
            'kontak'        =>  $request->kontak,
            'alamat'        =>  $request->alamat,
            'status'        =>  $request->status,
        ]);

        return redirect('supplier')->with('success-message', 'Data Success Disimpan !');
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required'  => ':attribute wajib di isi !!!',
            'integer'   => ':attribute format wajib menggunakan angka',
            'numeric'   => ':attribute format wajib menggunakan angka',
        ];

        $credentials = $request->validate([
            'supplier'        => 'required',
            'alamat'          => 'required',
            'kontak'          => 'required|numeric',
            'status'          => 'required',
        ], $messages);

        if ($request->status == 'Pilih Status') {
            return redirect('supplier')->with('errors-message', 'Status wajib di isi !!!');
        }

        Supplier::where('id', $id)
            ->update([
                'supplier'      =>  $request->supplier,
                'kontak'        =>  $request->kontak,
                'alamat'        =>  $request->alamat,
                'status'        =>  $request->status,
            ]);

        return redirect('supplier')->with('success-message', 'Data Success Disimpan !');
    }

    public function delete($id)
    {
        Supplier::where('id', $id)->update([
            'status'    =>  2,
        ]);

        return redirect('supplier')->with('success-message', 'Data Success Di Hapus !');
    }
}
