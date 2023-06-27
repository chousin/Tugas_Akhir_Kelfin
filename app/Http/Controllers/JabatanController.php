<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jabatan;

class JabatanController extends Controller
{
    public function index()
    {
        $data = Jabatan::with('karyawan')->get();
        // $data = Jabatan::all();


        return view('jabatan.index', [
            "title" => "Dashboard",
            "halaman" => "Home",
            "sub_hal" => "Data Jabatan",
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|',
            'jabatan' => 'required',
            'gaji_pokok' => 'required'
        ]);

        $jabatan = new Jabatan();
        $jabatan->id_karyawan = $request->id_karyawan;
        $jabatan->jabatan = $request->jabatan;
        $jabatan->gaji_pokok = $request->gaji_pokok;
        $jabatan->save();

        return redirect()->route('jabatan.index')->with('success', 'Data jabatan berhasil ditambahkan.');

    }

    public function update(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|',
            'jabatan' => 'required',
            'gaji_pokok' => 'required'
        ]);

        $jabatan = new Jabatan();
        $jabatan->id_karyawan = $request->id_karyawan;
        $jabatan->jabatan = $request->jabatan;
        $jabatan->gaji_pokok = $request->gaji_pokok;


        Jabatan::where('id', $request->id)->update($jabatan);

        return redirect()->route('jabatan.index')->with('success', 'Data jabatan berhasil diubah.');


    }



    public function delete_jabatan($id_jabatan)
    {
        $data = Jabatan::findOrFail($id_jabatan);
        $data->delete();
        return redirect()->route('jabatan.index')->with('success', 'Data Jabatan berhasil di hapus!!');
    }
    public function getJabatan($id)
    {
        $jabatan = Jabatan::find($id);

        return json_encode($jabatan);

    }

}