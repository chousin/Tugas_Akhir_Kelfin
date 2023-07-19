<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PengajuanPenggajian;

use App\Models\ListingKaryawan;

use App\Models\Karyawan;

use App\Models\Presensi;

use PDF;

use Dompdf\Dompdf;

use Dompdf\Options;


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
        $absensi_pegawai = [];

        foreach ($listing_karyawan as $karyawan) {
            $jumlahAbsen = Presensi::where('id_karyawan', $karyawan->id_karyawan)->count();
            $absensi_pegawai[$karyawan->id_karyawan] = $jumlahAbsen;
        }



        return view('penggajian.show', [
            'title' => 'Detail Penggajian',
            'halaman' => 'Detail',
            'sub_hal' => 'Detail Penggajian',
            'listing_karyawan' => $listing_karyawan,
            'pengajuan_penggajian' => $pengajuan_penggajian,
            'absensi_pegawai' => $absensi_pegawai
        ]);
    }

    public function cetak_detailPDF($id)
    {
        $pengajuan_penggajian = PengajuanPenggajian::findOrFail($id);
        $karyawan = ListingKaryawan::where('id_pengajuan_penggajian', $id)->first();

        if (!$karyawan || !$pengajuan_penggajian) {
            abort(404); // Tambahkan penanganan jika data tidak ditemukan
        }

        $data = [
            'pengajuan_penggajian' => $pengajuan_penggajian,
            'karyawan' => $karyawan,
        ];

        $html = view('penggajian.detail_pdf', $data)->render();

        $options = new Options();
        $options->setIsRemoteEnabled(true); // Enable loading remote stylesheets
        $options->setIsHtml5ParserEnabled(true); // Enable HTML5 parser

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $output = $dompdf->output();

        return response($output, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="cetak-detail-pdf.pdf"');
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

        foreach ($listing_karyawan as $karyawan) {
            $jumlahAbsen = Presensi::where('id_karyawan', $karyawan->id_karyawan)->count();
            $absensi_pegawai[$karyawan->id_karyawan] = $jumlahAbsen;
        }



        return view(
            'penggajian.rekap',
            [
                'title' => 'Data Penggajian ',
                'halaman' => 'Home',
                'sub_hal' => 'Rekap Data Penggajian',
                'absensi_pegawai' => $absensi_pegawai
            ],
            compact('listing_karyawan', 'jumlah_lemburs', 'jumlah_transports', 'pengajuan_penggajian')
        );
    }

    public function cetakPDF($id)
    {
        $pengajuan_penggajian = PengajuanPenggajian::findOrFail($id);
        $listing_karyawan = ListingKaryawan::where('id_pengajuan_penggajian', $id)->get();
        $jumlah_lemburs = $listing_karyawan->sum('jumlah_lembur');
        $jumlah_transports = $listing_karyawan->sum('nominal_transport');

        $data = [
            'title' => 'Data Penggajian',
            'halaman' => 'Home',
            'sub_hal' => 'Rekap Data Penggajian',
            'listing_karyawan' => $listing_karyawan,
            'jumlah_lemburs' => $jumlah_lemburs,
            'jumlah_transports' => $jumlah_transports,
            'pengajuan_penggajian' => $pengajuan_penggajian,
        ];

        $html = view('penggajian.rekap_pdf', $data)->render();
        $options = new Options();
        $options->setIsRemoteEnabled(true); // Enable loading remote stylesheets
        $options->setIsHtml5ParserEnabled(true); // Enable HTML5 parser

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $output = $dompdf->output();

        return response($output, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="rekap-penggajian.pdf"');
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