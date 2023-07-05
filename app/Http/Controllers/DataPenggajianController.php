<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PengajuanPenggajian;

use App\Models\ListingKaryawan;

class DataPenggajianController extends Controller
{
    public function index()
    {
        $pengajuan_penggajian = PengajuanPenggajian::all();
        return view('penggajian.index', [
            'title' => 'Data Penggajian',
            'halaman' => 'Home',
            'sub_hal' => 'Data Penggajian',
            'pengajuan_penggajian' => $pengajuan_penggajian
        ]);
    }

    public function show($id)
    {
        $pengajuan_penggajian = PengajuanPenggajian::findOrFail($id);
        $listing_karyawan = ListingKaryawan::all()->where('id_pengajuan_penggajian', $id);

        return view('penggajian.show', [
            'title' => 'Detail Penggajian',
            'halaman' => 'Detail',
            'sub_hal' => 'Detail Penggajian',
            'listing_karyawan' => $listing_karyawan,
            'pengajuan_penggajian' => $pengajuan_penggajian
        ]);
    }
}
