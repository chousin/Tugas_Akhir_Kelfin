@extends('layouts.main')

@section('container')



<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @if(!empty($listing_karyawan))
            @foreach($listing_karyawan as $karyawan)
            <div class="container">
                <div class="card">
                    <div class="card-header">
                    <a href="{{ route('cetak-pdf', ['status' => 'sudah-disetujui']) }}" class="btn btn-primary">Cetak PDF</a>
                        Periode 
                        <strong>{{ $pengajuan_penggajian->periode_start.' s/d '.$pengajuan_penggajian->periode_end }}</strong>
                        <span class="float-right"> <strong>Status:</strong> 
                            @if($pengajuan_penggajian->status_pengajuan == 1)
                                Sedang Direview
                            @endif

                            @if($pengajuan_penggajian->status_pengajuan == 2)
                                Disetujui
                            @endif
                        </span>

                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h6 class="mb-3">Penerima:</h6>
                                <div>
                                    <strong>{{ $karyawan->karyawan->nama_karyawan }}</strong>
                                </div>
                                <div>{{ $karyawan->karyawan->alamat }} | {{ $karyawan->karyawan->no_hp }}</div>
                                <div>{{ $karyawan->karyawan->tgl_lahir }} | {{ $karyawan->karyawan->jenis_kelamin }}</div>
                                <div>Status :
                                             @php
                                                $status_pernikahan = $karyawan->karyawan->status_pernikahan;

                                                if ($status_pernikahan == 'tk') {
                                                    $status = 'Belum Kawin';
                                                } elseif ($status_pernikahan == 'k0') {
                                                    $status = 'Kawin';
                                                }elseif ($status_pernikahan == 'k1') {
                                                    $status = 'Kawin';
                                                    $tanggungan = "memiliki anak 1";
                                                }elseif ($status_pernikahan == 'k2') {
                                                    $status = 'Kawin';
                                                    $tanggungan = "memiliki anak 2";
                                                }elseif ($status_pernikahan == 'k3') {
                                                    $status = 'Kawin';
                                                    $tanggungan = "memiliki anak 3";
                                                }else {
                                                    $status = 'Tidak Diketahui';
                                                }

                                                echo $status;
                                            @endphp 
                                        </div>
                                <div>KTP: {{ $karyawan->karyawan->no_ktp }}</div>
                                <div>Rekening : {{ $karyawan->karyawan->no_rekening }}</div>
                                <div>
                                    @if($karyawan->status_karyawan == 0)
                                    Jumlah Kerja : {{ $karyawan->jumlah_hari }}
                                    @endif
                                    
                                    
                                    
                                </div>
                                
                            </div>
                                
                            </div>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Item</th>
                                        <th>Description</th>

                                        
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="center">1</td>
                                        <td class="left strong">Gaji Pokok</td>
                                        <td class="left">
                                            @if($karyawan->status_karyawan == 0)
                                            (Gaji Pokok * Jumlah Hari Kerja)
                                            @else
                                            UMR
                                            @endif
                                        </td>

                                        
                                        @if($karyawan->status_karyawan == 0)
                                        <td class="right">
                                            @php
                                            $gaji_pokok = $karyawan->gaji_pokok;
                                            $jumlah_hari = $karyawan->jumlah_hari;

                                            $total = $gaji_pokok * $jumlah_hari;

                                            echo 'Rp. '.number_format($total);
                                            @endphp
                                        </td>
                                        @endif
                                        @if($karyawan->status_karyawan == 1)
                                        <td class="text-right">
                                            @php
                                            $gaji_pokok = $karyawan->gaji_pokok;

                                            echo 'Rp. '.number_format($gaji_pokok);
                                            @endphp
                                        </td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="center">2</td>
                                        <td class="left strong">Lembur</td>
                                        <td class="left">{{$karyawan->jumlah_lembur}} Jam </td>

                                        
                                        <td class="text-right">
                                            @if($karyawan->status_karyawan == 0)    
                                            @php
                                                
                                            $gaji_pokok = $karyawan->gaji_pokok;
                                            $jumlah_lembur = $karyawan->jumlah_lembur;
                                            $total_lembur = ($gaji_pokok / 8) * $jumlah_lembur;

                                            echo 'Rp. ' . number_format($total_lembur, 0, ',', '.');
                                            @endphp
                                            @endif

                                            @if($karyawan->status_karyawan == 1)    
                                            @php
                                            $gaji_pokok = $karyawan->gaji_pokok;
                                            $upah_per_jam = $gaji_pokok * (1 / 173);
                                            $uang_lembur_jam_pertama = 1.5 * $upah_per_jam;
                                            $uang_lembur_jam_selanjutnya = 2 * $upah_per_jam;
                                            $jumlah_lembur = $karyawan->jumlah_lembur;

                                            if ($jumlah_lembur > 0) {
                                                $total_upah_lembur = $uang_lembur_jam_pertama + ($uang_lembur_jam_selanjutnya * ($jumlah_lembur - 1));
                                            } else {
                                                $total_upah_lembur = 0;
                                            }

                                            echo 'Rp. ' . number_format($total_upah_lembur, 0, ',', '.');
                                            @endphp
                                            @endif
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center">3</td>
                                        <td class="left strong">Rembes</td>
                                        <td class="left"></td>

                                        
                                        <td class="text-right">Rp. {{ number_format($karyawan->nominal_rembes) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="center">4</td>
                                        <td class="left strong">Transport</td>
                                        <td class="left">(jumlah motor ke project x bensin)</td>

                                        
                                        <td class="text-right">Rp. {{ number_format($karyawan->nominal_transport) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="center"></td>
                                        <td class="left strong"></td>
                                        <td class="left">
                                                <strong>Sub Total</strong>
                                            </td>

                                        
                                        <td class="text-right">
                                                <strong>
                                                @if($karyawan->status_karyawan == 0)
                                                @php
                                                    $sub_total = $total + $total_lembur + $karyawan->nominal_rembes + $karyawan->nominal_transport;
                                                    echo 'Rp'.number_format($sub_total);
                                                @endphp
                                                @endif
                                                @if($karyawan->status_karyawan == 1)
                                                @php
                                                    $sub_total = $gaji_pokok + $total_upah_lembur + $karyawan->nominal_rembes + $karyawan->nominal_transport;
                                                    echo 'Rp'.number_format($sub_total);
                                                @endphp
                                                @endif
                                                </strong>
                                            </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5">

                            </div>
                            
                            </div>
                            @if($karyawan->status_karyawan == 1)
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>   
                                        <tr>
                                            <td class="left">
                                                <strong>Potongan(Hutang)</strong>
                                            </td>
                                            <td class="right text-danger">
                                            @php
                                            echo  '-Rp' . number_format($hutangPerKaryawan[$karyawan->id_karyawan]);
                                            @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong>biaya Jabatan (5%)</strong>
                                            </td>
                                            <td class="right text-danger">
                                            @php
                                            $jabatan = 0.05;
                                            $gajiPokok = $karyawan->gaji_pokok;
                                            $biaya_jabatan = $gajiPokok * $jabatan;
                                                    
                                            echo  '-Rp' . number_format($biaya_jabatan);
                                            @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong>Total</strong>
                                            </td>
                                            
                                            <td class="text-right">
                                            <strong>
                                                @php
                                                $total_gaji = $sub_total - $biaya_jabatan - $hutangPerKaryawan[$karyawan->id_karyawan];
                                                echo  'Rp' . number_format($total_gaji);
                                                @endphp
                                            </strong>
                                            </td>
                                            
                                        </tr>
                                    </tbody> 
                                </div>
                            </div>
                            @endif
                            @if($karyawan->status_karyawan == 0)
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>   
                                        <tr>
                                            <td class="left">
                                                <strong>Potongan(Hutang)</strong>
                                            </td>
                                            <td class="right text-danger">
                                            @php
                                            echo  '-Rp' . number_format($hutangPerKaryawan[$karyawan->id_karyawan]);
                                            @endphp
                                            </td>
                                        </tr>
                                        
                                    </tbody> 
                                </div>
                            </div>
                            @endif

                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left">
                                                <strong></strong>
                                            </td>
                                            <td class="right">
                                                
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            @if($karyawan->status_karyawan == 1)
                                                <td class="left strong fw-bold">Potongan PPh 21</td>
                                                <td class="text-right text-danger">
                                                @php
                                                // Perhitungan potongan pajak PPh 21
                                                    $gajiPokok = $karyawan->gaji_pokok;
                                                    $jumlahHariKerja = $karyawan->jumlah_hari;

                                                    // Penghasilan Tidak Kena Pajak (PTKP)
                                                    $ptkp = 54000000;
                                                    $statusPernikahan = $karyawan->karyawan->status_pernikahan; 

                                                    if ($statusPernikahan == 'tk') {
                                                        // Tidak kawin, jadi tidak ada tambahan PTKP
                                                    } elseif ($statusPernikahan == 'k0') {
                                                        // Kawin tetapi tidak memiliki anak, jadi menambahkan PTKP untuk kawin saja
                                                        $ptkp += 4500000;
                                                    } elseif ($statusPernikahan == 'k1') {
                                                        // Kawin dan memiliki 1 anak
                                                        $ptkp += 4500000; // untuk kawin
                                                        $ptkp += 4500000 * 1; // untuk 1 anak
                                                    } elseif ($statusPernikahan == 'k2') {
                                                        // Kawin dan memiliki 1 anak
                                                        $ptkp += 4500000; // untuk kawin
                                                        $ptkp += 4500000 * 2; // untuk 2 anak
                                                    }elseif ($statusPernikahan == 'k3') {
                                                        // Kawin dan memiliki 3 anak atau lebih
                                                        $ptkp += 4500000; // untuk kawin
                                                        $ptkp += 4500000 * min(3, substr($statusPernikahan, 1, 1)); // untuk anak, maksimal 3 tanggungan
                                                    }

                                                    $gaji_total_bulan = $total_gaji;
                                                    $gajiSetahun = $gaji_total_bulan * 12;

                                                    $penghasilanKenaPajak = $gajiSetahun > $ptkp ? $gajiSetahun - $ptkp : 0;

                                                    // Perhitungan Pajak Penghasilan
                                                    

                                                    $batas1 = 60000000;
                                                    $batas2 = 250000000;
                                                    $batas3 = 500000000;

                                                    $potonganPPh = 0;

                                                    if ($penghasilanKenaPajak <= $batas1) {
                                                        $potonganPPh = 0.05 * $penghasilanKenaPajak;
                                                    } else if ($penghasilanKenaPajak <= $batas2) {
                                                        $potonganPPh = (0.05 * $batas1) + (0.15 * ($penghasilanKenaPajak - $batas1));
                                                    } else if ($penghasilanKenaPajak <= $batas3) {
                                                        $potonganPPh = (0.05 * $batas1) + (0.15 * ($batas2 - $batas1)) + (0.25 * ($penghasilanKenaPajak - $batas2));
                                                    } else {
                                                        $potonganPPh = (0.05 * $batas1) + (0.15 * ($batas2 - $batas1)) + (0.25 * ($batas3 - $batas2)) + (0.30 * ($penghasilanKenaPajak - $batas3));
                                                    }

                                                    $potonganPPhBulanan = $potonganPPh / 12;

                                                    
                                                    echo  'Rp. ' . number_format($potonganPPhBulanan, 0, ',', '.');

                                                @endphp

                                                </td>
                                            </tr>
                                            @endif
                                        
                                        
                                            <td class="left">
                                                <strong>Total Diterima</strong>
                                            </td>
                                            <td class="text-right">
                                                <strong>
                                                @if($karyawan->status_karyawan == 0)
                                                @php
                                                $total_hutang = $hutangPerKaryawan[$karyawan->id_karyawan];
                                                
                                                echo 'Rp.'.number_format($sub_total - $total_hutang);
                                                
                                                @endphp
                                                @endif
                                                @if($karyawan->status_karyawan == 1)
                                                
                                                 Rp.{{number_format($total_gaji   - $potonganPPhBulanan )}}
                                                
                                                @endif
                                                </strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
@endsection