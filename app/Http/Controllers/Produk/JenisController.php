<?php

namespace App\Http\Controllers\Produk;

use App\Models\Jenis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;

class JenisController extends Controller
{
    public function index()
    {
        $jenis = Jenis::all();

        return view('produk.jenis', ['jenis' => $jenis]);
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib di isi !!!',
            'mimes'    => ':attribute format wajib menggunakan PNG/JPG'
        ];

        $credentials = $request->validate([
            'jenis'         => 'required',
            'icon'          => 'mimes:png,jpg,jpeg',
            'status'        => 'required',
        ], $messages);

        if ($request->status == 'Pilih Status') {
            return redirect('jenis')->with('errors-message', 'Status wajib di isi !!!');
        }

        $icon = "";
        if ($request->file('icon')) {
            $extension = $request->file('icon')->getClientOriginalExtension();
            $icon = $request->jenis . '.' . $extension;
            $request->file('icon')->storeAs('Icon', $icon);
            $request['icon'] = $icon;
        }

        Jenis::create([
            'jenis'  => $request->jenis,
            'icon'   => $icon,
            'status' => $request->status
        ]);

        return redirect('jenis')->with('success-message', 'Data Success Disimpan !');
    }

    public function update(Request $request, $id)
    {
        $jenis = Jenis::where('id', $id)->first();

        $messages = [
            'required' => ':attribute wajib di isi !!!',
            'mimes'    => ':attribute format wajib menggunakan PNG/JPG'
        ];

        $credentials = $request->validate([
            'jenis'         => 'required',
            'icon'          => 'mimes:png,jpg,jpeg',
            'status'        => 'required',
        ], $messages);

        if ($request->status == 'Pilih Status') {
            return redirect('jenis')->with('errors-message', 'Status wajib di isi !!!');
        }

        if ($request->file('icon')) {

            $path = 'storage/Icon/' . $jenis->icon;

            if (File::exists($path)) {
                File::delete($path);
            }

            $extension = $request->file('icon')->getClientOriginalExtension();
            $newphoto = $request->jenis . '.' . $extension;
            $request->file('icon')->storeAs('Icon', $newphoto);
            $request['icon'] = $newphoto;

            Jenis::where('id', $id)
                ->update([
                    'jenis'  => $request->jenis,
                    'icon'  => $newphoto,
                    'status' => $request->status
                ]);
        } else {
            Jenis::where('id', $id)
                ->update([
                    'jenis'  => $request->jenis,
                    'status' => $request->status
                ]);
        }

        return redirect('jenis')->with('success-message', 'Data Success Diupdate !');
    }

    public function delete($id)
    {
        $jenis = Jenis::where('id', $id)->first();

        $path = 'storage/Icon/' . $jenis->icon;

        if (File::exists($path)) {
            File::delete($path);
        }

        Jenis::where('id', $id)->delete();

        return redirect('jenis')->with('success-message', 'Data Success Dihapus !');
    }
}
