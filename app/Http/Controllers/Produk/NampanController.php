<?php

namespace App\Http\Controllers\Produk;

use Carbon\Carbon;
use App\Models\Jenis;
use App\Models\Nampan;
use App\Models\Produk;
use Faker\Guesser\Name;
use App\Models\nampanProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NampanController extends Controller
{
    public function index()
    {
        $nampan = Nampan::all();
        $jenis  = Jenis::all();

        return view('produk.nampan', ['nampan' => $nampan, 'jenis' => $jenis]);
    }

    public function show($id)
    {
        $nampanJenis = Nampan::where('id', $id)->first()->jenis_id;
        $produk = Produk::where('status', 1)->where('jenis_id', $nampanJenis)->get();
        $nampan = nampanProduk::where('nampan_id', $id)->get();
        $nampanId = $id;
        return view('produk.detail-produk', ['produk' => $produk, 'nampan' => $nampan, 'nampanID' => $nampanId]);
    }

    public function storeNampan(Request $request, $id)
    {
        $request->validate([
            'items' => 'required|array',
        ]);

        foreach ($request->items as $item) {
            if (DB::table('nampan_produk')->where('produk_id', $id)->where('deleted_at', '!=', null)->exists()) {
                return redirect('nampan/' . $id)->with('errors-message', 'Data Kode Produk Sudah Ada !');
            } else {
                nampanProduk::create([
                    'nampan_id' =>  $id,
                    'produk_id' =>  $item,
                    'tanggal'   =>  Carbon::today()->format('Y-m-d')
                ]);
            }
        }

        return redirect('nampan/' . $id)->with('success-message', 'Data Success Disimpan !');
    }

    public function store(Request $request)
    {

        $currentdate = Carbon::today()->format('Y-m-d');

        $messages = [
            'required' => ':attribute wajib di isi !!!',
        ];

        $credentials = $request->validate([
            'jenis'         => 'required',
            'nampan'        => 'required',
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
                'status'    =>  $request->status,
            ]);

        return redirect('nampan')->with('success-message', 'Data Success Diupdate !');
    }

    public function delete($id)
    {
        Nampan::where('id', $id)->delete();

        return redirect('nampan')->with('success-message', 'Data Success Dihapus !');
    }

    public function deleteNampan($id)
    {
        nampanProduk::where('id', $id)->delete();

        return redirect('nampan/' . $id)->with('success-message', 'Data Success Dihapus !');
    }
}
