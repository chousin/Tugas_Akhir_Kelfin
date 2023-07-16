<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\ListingKaryawan;

use App\Models\PengajuanPenggajian;

use App\Models\Karyawan;

use Dompdf\Dompdf;

use Dompdf\Options;

class DataGajiKaryawan extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all()->where('id_user', Auth::user()->id)->first();
        $pengajuan_penggajian = PengajuanPenggajian::all()->where('status_pengajuan', 2);

        $result_array = [];
        foreach ($pengajuan_penggajian as $get_pengajuan_penggajian) {
            $listing_karyawan = ListingKaryawan::all()->where('id_pengajuan_penggajian', $get_pengajuan_penggajian->id)->where('id_karyawan', $karyawan->id_karyawan);

            foreach ($listing_karyawan as $get_listing_karyawan) {
                $custom_result = $get_listing_karyawan;

                array_push($result_array, $custom_result);
            }
        }

        return view('gaji.index', [
            "title" => "Data Gaji",
            "halaman" => "Home",
            "sub_hal" => "Data Karyawan",
            "listing_karyawan" => $result_array,
            "pengajuan_penggajian" => $pengajuan_penggajian->first()
        ]);
    }

    public function cetakPDF($status = null)
    {
        $karyawan = Karyawan::where('id_user', Auth::user()->id)->first();
        $pengajuan_penggajians = PengajuanPenggajian::where('status_pengajuan', 2)->get();
        $pengajuan_penggajian = PengajuanPenggajian::where('status_pengajuan', 2)->first();

        $result_array = [];
        foreach ($pengajuan_penggajians as $get_pengajuan_penggajian) {
            $listing_karyawan = ListingKaryawan::where('id_pengajuan_penggajian', $get_pengajuan_penggajian->id)
                ->where('id_karyawan', $karyawan->id_karyawan)
                ->get();

            foreach ($listing_karyawan as $get_listing_karyawan) {
                $custom_result = $get_listing_karyawan;
                $result_array[] = $custom_result;
            }
        }

        $html = view('gaji.pdf', compact('pengajuan_penggajian', 'listing_karyawan', 'pengajuan_penggajians'))->render();
        $options = new Options();
        $options->setIsHtml5ParserEnabled(true);
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('slip_gaji.pdf', ['Attachment' => false]);
    }
}