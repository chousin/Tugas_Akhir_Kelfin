<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rembes;

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
            'id_karyawan' => 'required|',
            'jabatan' => 'required',
            'gaji_pokok' => 'required'
        ]);

        $rembes = new Rembes();
        $rembes->id_karyawan = $request->id_karyawan;
        $rembes->nominal = $request->nominal;
        $rembes->bukti_nota = $request->bukti_nota;


        Rembes::where('id', $request->id)->update($rembes);

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
        $rembes = Rembes::find($id);

        return json_encode($rembes);

    }
}