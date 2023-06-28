<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;
use Illuminate\Support\Facades\Response;
use App\Models\Karyawan;

class TransportController extends Controller
{
    public function index()
    {
        $data = Transport::with('karyawan')->get();

        return view('transport.index', [
            "title" => "Dashboard",
            "halaman" => "Home",
            "sub_hal" => "Data Transport",
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|',
            'jenis_bensin_produk' => 'required',
            'liter_volume' => 'required',
            'harga_liter' => 'required',
            'bukti_struk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $transport = new Transport();
        $transport->id_karyawan = $request->id_karyawan;
        $transport->jenis_bensin_produk = $request->jenis_bensin_produk;
        $transport->liter_volume = $request->liter_volume;
        $transport->harga_liter = $request->harga_liter;


        if ($request->hasFile('bukti_struk')) {
            $image = $request->file('bukti_struk');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images_bukti_nota_bensin'), $imageName);
            $transport->bukti_struk = $imageName;
        }
        $transport->save();

        return redirect()->route('transport.index')->with('success', 'Data Transport berhasil ditambahkan.');

    }

    public function update(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required',
            'jenis_bensin_produk' => 'required',
            'liter_volume' => 'required',
            'harga_liter' => 'required',
            'bukti_struk' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $transport = Transport::findOrFail($request->id);

        $transport->id_karyawan = $request->id_karyawan;
        $transport->jenis_bensin_produk = $request->jenis_bensin_produk;
        $transport->liter_volume = $request->liter_volume;
        $transport->harga_liter = $request->harga_liter;

        if ($request->hasFile('bukti_struk')) {
            $image = $request->file('bukti_struk');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images_bukti_nota_bensin'), $imageName);
            $transport->bukti_struk = $imageName;
        }

        $transport->save();

        return redirect()->route('transport.index')->with('success', 'Data Transport berhasil diubah.');
    }





    public function delete_transport($id_transport)
    {
        $data = Transport::findOrFail($id_transport);
        $data->delete();
        return redirect()->route('transport.index')->with('success', 'Data Transport berhasil di hapus!!');
    }
    public function getTransport($id)
    {
        $transport = Transport::with('karyawan')->findOrFail($id);
        $karyawan = Karyawan::all();

        $resultKaryawan = [
            'transport' => $transport,
            'karyawan' => $karyawan
        ];

        return Response::json($resultKaryawan);
    }


}