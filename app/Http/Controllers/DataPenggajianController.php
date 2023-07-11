<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PengajuanPenggajian;

use App\Models\ListingKaryawan;

use App\Models\Karyawan;

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

    public function approve($id)
    {
        $row = [
            'status_pengajuan' => 2
        ];

        $pengajuan_penggajian = PengajuanPenggajian::findOrFail($id);
        $pengajuan_penggajian->update($row);

        return redirect('/data-penggajian');
    }

    public function cetak($id)
    {
        $pengajuan_penggajian = PengajuanPenggajian::findOrFail($id);
        $listing_karyawan = ListingKaryawan::all()->where('id_pengajuan_penggajian', $id);
        $jumlah_lemburs = ListingKaryawan::all()->sum('jumlah_lembur');
        $jumlah_transports = ListingKaryawan::all()->sum('nominal_transport');

        return view('penggajian.cetak', compact('listing_karyawan', 'jumlah_lemburs', 'jumlah_transports'));
    }
    public function rekap($id)
    {
        $pengajuan_penggajian = PengajuanPenggajian::findOrFail($id);
        $listing_karyawan = ListingKaryawan::all()->where('id_pengajuan_penggajian', $id);
        $jumlah_lemburs = ListingKaryawan::all()->sum('jumlah_lembur');
        $jumlah_transports = ListingKaryawan::all()->sum('nominal_transport');

        return view(
            'penggajian.rekap',
            [
                'title' => 'Data Penggajian ',
                'halaman' => 'Home',
                'sub_hal' => 'Rekap Data Penggajian',
            ],
            compact('listing_karyawan', 'jumlah_lemburs', 'jumlah_transports')
        );
    }

    public function list()
    {
        $pengajuan_penggajian = PengajuanPenggajian::all()->where('status_pengajuan', 2);
        return view('penggajian.approve', [
            'title' => 'Data Penggajian Disetujui',
            'halaman' => 'Home',
            'sub_hal' => 'Data Penggajian disetujui',
            'pengajuan_penggajian' => $pengajuan_penggajian
        ]);
    }
}