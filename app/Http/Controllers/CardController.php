<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Presensi;

use App\Models\Karyawan;

use Auth;

class CardController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all()->where('id_user', Auth::user()->id)->first();
        $presensi = Presensi::all()->where('id_karyawan', $karyawan->id_karyawan);

        $result = [];
        foreach($presensi as $get_presensi){
            $result_array = [
                'title' => 'ABSEN',
                'start' => substr($get_presensi->tanggal_masuk, 0, 10),
                'end' => substr($get_presensi->tanggal_pulang, 0 , 10)
            ];

            array_push($result, $result_array);
        }

        $data_absen = json_encode($result);

        return view('components.card', [
            "title" => "Dashboard",
            "halaman" => "Home",
            "sub_hal" => "Dashboard",
            "data_absen" => $data_absen
        ]);
    }
}