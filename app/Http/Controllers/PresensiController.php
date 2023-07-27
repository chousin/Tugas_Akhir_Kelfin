<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Karyawan;

use App\Models\Presensi;

use Auth;

use Session;

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
        $JumlahAbsen = Presensi::where('id_karyawan', $id)->count();

        return view('presensi.show', [
            "title" => "Presensi",
            "halaman" => "Home",
            "sub_hal" => "Data Presensi",
            "presensi" => $presensi,
            "JumlahAbsen" => $JumlahAbsen
        ]);
    }
    public function pulang_presensi($id, $karyawan)
    {
        $presensi = Presensi::find($id);

        $tanggal_pulang = date('Y-m-d H:i:s');
        $tanggal_masuk_in = strtotime($presensi->tanggal_masuk);
        $tanggal_pulang_out = strtotime($tanggal_pulang);
        $maksimal_jam = 8;

        $timeDiff = $tanggal_pulang_out - $tanggal_masuk_in;

        $hours = floor($timeDiff / 3600);

        $calculate_jam = $hours - $maksimal_jam;

        if ($calculate_jam > 0) {
            $jumlah_lembur = $calculate_jam;
        } else {
            $jumlah_lembur = 0;
        }

        $rows = [
            'id_karyawan' => $presensi->id_karyawan,
            'tanggal_pulang' => $tanggal_pulang,
            'jumlah_lembur' => $jumlah_lembur
        ];

        $presensi = Presensi::where('id', $id)->update($rows);
        return redirect('/presensi/' . $karyawan);
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