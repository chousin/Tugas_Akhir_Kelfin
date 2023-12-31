<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index()
    {

        $data = Karyawan::all();
        return view('karyawan.index', [
            "title" => "Dashboard",
            "halaman" => "Home",
            "sub_hal" => "Data Karyawan",
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_karyawan' => 'required|max:100',
            'alamat' => 'required|max:225',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required|min:12|max:15',
            'no_ktp' => 'required|min:16|max:16',
            'no_rekening' => 'required|max:50'
        ]);

        $validatedData['tgl_lahir'] = $request->tgl_lahir;

        Karyawan::create($validatedData);


        return redirect('/karyawan')->with('success', 'Tambah data berhasil');

    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'nama_karyawan' => 'required|max:100',
            'alamat' => 'required|max:225',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required|min:12|max:15',
            'no_ktp' => 'required|min:16|max:16',
            'no_rekening' => 'required|max:50'
        ]);

        Karyawan::where('id', $request->id)->update($validatedData);

        return redirect('/karyawan')->with('success', 'Edit data berhasil');
    }

    public function delete_karyawan($id_karyawan)
    {
        $data = Karyawan::findOrFail($id_karyawan);
        $data->delete();
        return redirect('/karyawan')->with('success', 'Data Karyawan berhasil di hapus!!');
    }
    public function getKaryawan($id)
    {
        $karyawan = Karyawan::find($id);

        return json_encode($karyawan);

    }
}