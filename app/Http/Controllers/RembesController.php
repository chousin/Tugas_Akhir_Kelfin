<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rembes;
use Illuminate\Support\Facades\Response;
use App\Models\Karyawan;

class RembesController extends Controller
{
    public function index()
    {
        $data = Rembes::with('karyawan')->get();

        return view('rembes.index', [
            "title" => "Dashboard",
            "halaman" => "Home",
            "sub_hal" => "Data Rembes",
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|',
            'nominal' => 'required',
            'bukti_nota' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $jabatan = new Rembes();
        $jabatan->id_karyawan = $request->id_karyawan;
        $jabatan->nominal = $request->nominal;

        if ($request->hasFile('bukti_nota')) {
            $image = $request->file('bukti_nota');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images_bukti_nota'), $imageName);
            $jabatan->bukti_nota = $imageName;
        }
        $jabatan->save();

        return redirect()->route('rembes.index')->with('success', 'Data Rembes berhasil ditambahkan.');

    }

    public function update(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required',
            'nominal' => 'required',
            'bukti_nota' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $rembes = Rembes::findOrFail($request->id); // Mengambil objek Rembes berdasarkan ID

        $rembes->id_karyawan = $request->id_karyawan;
        $rembes->nominal = $request->nominal;

        if ($request->hasFile('bukti_nota')) {
            $image = $request->file('bukti_nota');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images_bukti_nota'), $imageName);
            $rembes->bukti_nota = $imageName;
        }

        $rembes->save(); // Menyimpan perubahan pada objek Rembes

        return redirect()->route('rembes.index')->with('success', 'Data Rembes berhasil diubah.');
    }




    public function delete_rembes($id_rembes)
    {
        $data = Rembes::findOrFail($id_rembes);
        $data->delete();
        return redirect()->route('rembes.index')->with('success', 'Data Rembes berhasil di hapus!!');
    }
    public function getRembes($id)
    {
        $rembes = Rembes::with('karyawan')->findOrFail($id);
        $karyawan = Karyawan::all();

        $resultKaryawan = [
            'rembes' => $rembes,
            'karyawan' => $karyawan
        ];

        return Response::json($resultKaryawan);
    }
}