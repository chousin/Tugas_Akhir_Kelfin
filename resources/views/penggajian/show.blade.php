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
                                <div>KTP: {{ $karyawan->karyawan->no_ktp }}</div>
                                <div>Rekening : {{ $karyawan->karyawan->no_rekening }}</div>
                                <div>
                                    @if($karyawan->status_karyawan == 0)
                                    Jumlah Kerja : {{ $karyawan->jumlah_hari }}
                                    @endif
                                    @if($karyawan->status_karyawan == 1)
                                    Jumlah Kerja : {{$totalAbsen = $absensi_pegawai[$karyawan->id_karyawan]}}
                                    @endif
                                    
                                    
                                    
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

                                        <th class="right"></th>
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

                                        <td class="right"></td>
                                        <td class="right">
                                            @php
                                            $gaji_pokok = $karyawan->gaji_pokok;
                                            $jumlah_hari = $karyawan->jumlah_hari;

                                            $total = $gaji_pokok * $jumlah_hari;

                                            echo 'Rp. '.number_format($total);
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center">2</td>
                                        <td class="left strong">Lembur</td>
                                        <td class="left">{{$karyawan->jumlah_lembur}} Jam </td>

                                        <td class="right"></td>
                                        <td class="right">
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
                                                $total_upah_lembur = ($uang_lembur_jam_pertama + ($uang_lembur_jam_selanjutnya * ($jumlah_lembur - 1))) * $jumlah_lembur;
                                            } else {
                                                $total_upah_lembur = 0;
                                            }

                                            echo 'Rp. ' . number_format($total_upah_lembur, 0, ',', '.');
                                            @endphp
                                            @endif
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center">2</td>
                                        <td class="left strong">Hutang/Kasbon</td>
                                        <td class="left"></td>

                                        <td class="right"></td>
                                        <td class="right">Rp. {{ number_format($karyawan->nominal_hutang) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="center">3</td>
                                        <td class="left strong">Rembes</td>
                                        <td class="left"></td>

                                        <td class="right"></td>
                                        <td class="right">Rp. {{ number_format($karyawan->nominal_rembes) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="center">4</td>
                                        <td class="left strong">Transport</td>
                                        <td class="left">(jumlah motor ke project x bensin)</td>

                                        <td class="right"></td>
                                        <td class="right">Rp. {{ number_format($karyawan->nominal_transport) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5">

                            </div>

                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left">
                                                <strong>Subtotal</strong>
                                            </td>
                                            <td class="right">
                                                @if($karyawan->status_karyawan == 0)
                                                @php
                                                    $sub_total = $total + $total_lembur + $karyawan->nominal_rembes + $karyawan->nominal_transport;
                                                    echo 'Rp'.number_format($sub_total);
                                                @endphp
                                                @endif
                                                @if($karyawan->status_karyawan == 1)
                                                @php
                                                    $sub_total = $total + $total_upah_lembur + $karyawan->nominal_rembes + $karyawan->nominal_transport;
                                                    echo 'Rp'.number_format($sub_total);
                                                @endphp
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong>Potongan(Hutang)</strong>
                                            </td>
                                            
                                            <td class="right text-danger">
                                            @php
                                            echo '-Rp' . number_format($karyawan->nominal_hutang);
                                            @endphp
                                            </td>
                                        </tr>
                                        
                                        
                                            <td class="left">
                                                <strong>Total Diterima</strong>
                                            </td>
                                            <td class="right">
                                                <strong>
                                                @if($karyawan->status_karyawan == 0)
                                                @php
                                                
                                                echo 'Rp.'.number_format($sub_total - $karyawan->nominal_hutang);
                                                
                                                @endphp
                                                @endif
                                                @if($karyawan->status_karyawan == 1)
                                                
                                                 Rp.{{number_format($sub_total  - $karyawan->nominal_hutang )}}
                                                
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