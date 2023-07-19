<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PengajuanPenggajianRequest;

use App\Models\PengajuanPenggajian;

use App\Models\Jabatan;

use App\Models\ListingKaryawan;

use App\Models\Hutang;

use App\Models\Rembes;

use App\Models\Transport;

use App\Models\Presensi;

use Carbon\Carbon;

use Session;

use Auth;

class PengajuanPenggajianController extends Controller
{
    public function index()
    {
        $pengajuan_penggajian = PengajuanPenggajian::all()->where('status_pengajuan', 2)->last();

        return view('pengajuan_penggajian.index', [
            'title' => 'Pengajuan Penggajian',
            'halaman' => 'Home',
            'sub_hal' => 'Pengajuan Penggajian',
            'pengajuan_penggajian' => $pengajuan_penggajian
        ]);
    }

    public function store(PengajuanPenggajianRequest $request)
    {
        $request['id_user'] = Auth::user()->id;
        $request['status_pengajuan'] = 1;
        $pengajuan_penggajian = PengajuanPenggajian::create($request->all());

        $jabatan = Jabatan::all();

        $result_jabatan = [];
        foreach ($jabatan as $get_jabatan) {
            $hutang = Hutang::where('created_at', '>=', Carbon::parse($request->periode_start . '00:00:00'))->where('created_at', '<=', Carbon::parse($request->periode_end . '23:59:00'))->where('id_karyawan', $get_jabatan->id_karyawan)->sum('nominal_hutang');
            $rembes = Rembes::where('created_at', '>=', Carbon::parse($request->periode_start . '00:00:00'))->where('created_at', '<=', Carbon::parse($request->periode_end . '23:59:00'))->where('id_karyawan', $get_jabatan->id_karyawan)->sum('nominal');
            $transport = Transport::where('created_at', '>=', Carbon::parse($request->periode_start . '00:00:00'))->where('created_at', '<=', Carbon::parse($request->periode_end . '23:59:00'))->where('id_karyawan', $get_jabatan->id_karyawan)->sum('total');
            $presensi = Presensi::all()->where('id_karyawan', $get_jabatan->id_karyawan)->whereBetween('tanggal_masuk', [$request->periode_start . ' 00:00:00', $request->periode_end . ' 23:59:59']);
            $lembur = Presensi::all()->where('id_karyawan', $get_jabatan->id_karyawan)->whereBetween('tanggal_masuk', [$request->periode_start . ' 00:00:00', $request->periode_end . ' 23:59:59']);

            $array_jabatan = [
                'id_pengajuan_penggajian' => $pengajuan_penggajian->id,
                'id_karyawan' => $get_jabatan->id_karyawan,
                'status_karyawan' => $get_jabatan->status_karyawan,
                'gaji_pokok' => $get_jabatan->gaji_pokok,
                'jumlah_hari' => $presensi->count(),
                'nominal_hutang' => $hutang,
                'nominal_rembes' => $rembes,
                'nominal_transport' => $transport,
                'jumlah_lembur' => $lembur->sum('jumlah_lembur'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            array_push($result_jabatan, $array_jabatan);
        }

        ListingKaryawan::insert($result_jabatan);

        Session::flash('flash_message', 'Pengajuan berhasil diajukan.');
        return redirect('pengajuan-penggajian');
    }
}