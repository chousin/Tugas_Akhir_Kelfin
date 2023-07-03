<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\Presensi;
use App\Models\Karyawan;

use Session;

class AbsenController extends Controller
{
    public function index()
    {
        $presensi = Presensi::all()->where('id', Session::get('sesi_absen'))->first();

        return view('presensi.presensi', [
            "title" => "Dashboard",
            "halaman" => "Home",
            "sub_hal" => "Presensi",
            "presensi" => $presensi
        ]);
    }

    public function store(Request $request)
    {
        $id_user = Auth::user()->id;
        $user = Karyawan::all()->where('id_user', $id_user)->first();

        $rows = [
            'id_karyawan' => $user->id_karyawan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tanggal_masuk' => date('Y-m-d H:i:s'),
            'tanggal_pulang' => date('Y-m-d H:i:s'),
            'jumlah_lembur' => 0,
        ];

        $presensi = Presensi::create($rows);

        Session::put('sesi_absen', $presensi->id);
        return redirect('/absen');
    }

    public function pulang(Request $request)
    {
        $id_user = Auth::user()->id;
        $user = Karyawan::all()->where('id_user', $id_user)->first();

        $tanggal_pulang = date('Y-m-d H:i:s');

        $tanggal_clockout = strtotime($tanggal_pulang);
        $target_time = strtotime(date('Y-m-d') . '16:00:00');

        $timeDiff = $tanggal_clockout - $target_time;

        $hours = floor($timeDiff / 3600);

        if($hours > 0){
            $jumlah_lembur = $hours;
        }else{
            $jumlah_lembur = 0;
        }

        $rows = [
            'id_karyawan' => $user->id_karyawan,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tanggal_pulang' => $tanggal_pulang,
            'jumlah_lembur' => $jumlah_lembur
        ];

        $presensi = Presensi::where('id', Session::get('sesi_absen'))->update($rows);
        return redirect('/absen');
    }

    public function reset()
    {
        Session::forget('sesi_absen');
        return redirect('/absen');
    }
}