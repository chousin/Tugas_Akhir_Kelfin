<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hutang;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Response;

class HutangController extends Controller
{
    public function index()
    {
        $data = Hutang::with('karyawan')->get();

        return view('hutang.index', [
            "title" => "Dashboard",
            "halaman" => "Home",
            "sub_hal" => "Data Hutang",
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|',
            'nominal_hutang' => 'required',
            'keterangan' => 'required'
        ]);

        $hutang = new Hutang();
        $hutang->id_karyawan = $request->id_karyawan;
        $hutang->nominal_hutang = $request->nominal_hutang;
        $hutang->keterangan = $request->keterangan;
        $hutang->save();

        return redirect()->route('hutang.index')->with('success', 'Data Hutang berhasil ditambahkan.');

    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id_karyawan' => 'required',
            'nominal_hutang' => 'required',
            'keterangan' => 'required'
        ]);

        $jabatan = Hutang::findOrFail($request->id); // Mengambil objek Jabatan berdasarkan ID

        $jabatan->id_karyawan = $validatedData['id_karyawan'];
        $jabatan->nominal_hutang = $validatedData['nominal_hutang'];
        $jabatan->keterangan = $validatedData['keterangan'];

        $jabatan->save(); // Menyimpan perubahan pada objek Jabatan
        return redirect()->route('hutang.index')->with('success', 'Data Hutang berhasil diubah.');
    }



    public function delete_hutang($id_hutang)
    {
        $data = Hutang::findOrFail($id_hutang);
        $data->delete();
        return redirect()->route('hutang.index')->with('success', 'Data Hutang berhasil di hapus!!');
    }
    public function getHutang($id)
    {
        $hutang = Hutang::with('karyawan')->findOrFail($id);
        $karyawan = Karyawan::all();

        $resultKaryawan = [
            'hutang' => $hutang,
            'karyawan' => $karyawan
        ];

        return Response::json($resultKaryawan);

    }


}