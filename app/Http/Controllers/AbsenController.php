<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class AbsenController extends Controller
{
    public function index()
    {
        return view('presensi.presensi', [
            "title" => "Dashboard",
            "halaman" => "Home",
            "sub_hal" => "Presensi",
        ]);
    }

    public function store(Request $request)
    {
        $id_user = Auth::user()->id;

        $rows = [
            'id_karyawan' => $id_user,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tanggal_masuk' => date('Y-m-d H:i:s'),
            'tanggal_pulang' => null
        ];

        return $rows;
    }

    public function pulang(Request $request)
    {
        $rows = [
            'id_karyawan' => 1,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tanggal_pulang' => date('Y-m-d H:i:s')
        ];

        return $rows;
    }
}