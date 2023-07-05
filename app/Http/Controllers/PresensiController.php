<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Karyawan;

use App\Models\Presensi;

class PresensiController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all();

        return view('presensi.index', [
            "title" => "Presensi",
            "halaman" => "Home",
            "sub_hal" => "Data Presensi",
            "karyawan" => $karyawan
        ]);
    }

    public function show($id)
    {
        $presensi = Presensi::all()->where('id_karyawan', $id);
        return view('presensi.show', [
            "title" => "Presensi",
            "halaman" => "Home",
            "sub_hal" => "Data Presensi",
            "presensi" => $presensi
        ]);
    }

    public function lokasi($id)
    {
        $presensi = Presensi::all()->where('id', $id)->first();

        return view('presensi.lokasi', [
            "title" => "Presensi",
            "halaman" => "Home",
            "sub_hal" => "Data Presensi",
            "presensi" => $presensi
        ]);
    }
}
