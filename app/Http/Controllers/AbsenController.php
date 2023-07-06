<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\Presensi;
use App\Models\Karyawan;

use Session;

use Carbon\Carbon;

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
        $presensi = Presensi::whereDate('created_at', Carbon::now())->where('id_karyawan', $user->id_karyawan)->get();

        if($presensi->count() >= 1){
            Session::flash('flash_message', 'Absen hanya bisa 1 kali dalam 1 hari.');
            return redirect('/absen');
        }else{
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
    }

    public function pulang(Request $request)
    {
        $id_user = Auth::user()->id;
        $user = Karyawan::all()->where('id_user', $id_user)->first();

        $tanggal_pulang = date('Y-m-d H:i:s');

        if($tanggal_pulang <= date('Y-m-d').' 16:00:00'){
            Session::flash('flash_message', 'Tidak bisa melakukan absen pulang sebelum jam 16:00 WIB');
            return redirect('/absen');
        }else{
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
    }

    public function reset()
    {
        Session::forget('sesi_absen');
        return redirect('/absen');
    }
}