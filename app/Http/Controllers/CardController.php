<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Presensi;

use App\Models\Karyawan;

use App\Models\PengajuanPenggajian;

use Auth;

class CardController extends Controller
{
    public function index()
    {
        $totalKaryawan = 0;
        $totalPenggajianProses = 0;
        $totalPenggajianSukses = 0;

        if (Auth::user()->role == 'pegawai') {
            $karyawan = Karyawan::all()->where('id_user', Auth::user()->id)->first();
            $presensi = Presensi::all()->where('id_karyawan', $karyawan->id_karyawan);

            $result = [];
            foreach ($presensi as $get_presensi) {
                $result_array = [
                    'title' => 'ABSEN',
                    'start' => substr($get_presensi->tanggal_masuk, 0, 10),
                    'end' => substr($get_presensi->tanggal_pulang, 0, 10)
                ];

                array_push($result, $result_array);
            }

            $data_absen = json_encode($result);
        } else if (Auth::user()->role == 'admin') {
            $totalKaryawan = Karyawan::all()->count();
            $totalPenggajianProses = PengajuanPenggajian::where('status_pengajuan', 1)->count();
            $totalPenggajianSukses = PengajuanPenggajian::where('status_pengajuan', 2)->count();
            $data_absen = [];
        } else {
            $data_absen = [];
        }


        return view('components.card', [
            "title" => "Dashboard",
            "halaman" => "Home",
            "sub_hal" => "Dashboard",
            'totalKaryawan' => $totalKaryawan,
            'totalPenggajianProses' => $totalPenggajianProses,
            'totalPenggajianSukses' => $totalPenggajianSukses,
            "data_absen" => $data_absen
        ]);
    }
}