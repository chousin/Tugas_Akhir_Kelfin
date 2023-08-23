@extends('layouts.main')

@section('container')

            
<div class="card">
    <div class="container-fluid">
        <div class="mt-5">
        

            <div class="mt-3 table-responsive-sm">
            
            <a href="{{ route('penggajian.cetak-pdf', ['id' => $pengajuan_penggajian->id]) }}" target="_blank" class="btn btn-primary">Cetak PDF</a>
                
            
            <h3 class="font-monospace  fw-bolder">{{$pengajuan_penggajian->keterangan}}</h3>
           

            <h3 class="font-monospace  fw-bolder">Periode {{$pengajuan_penggajian->periode_start}} S/D {{$pengajuan_penggajian->periode_end}}</h3>

            <span class="float-right"> <strong>Status:</strong> 
                            @if($pengajuan_penggajian->status_pengajuan == 1)
                                Sedang Direview
                            @endif

                            @if($pengajuan_penggajian->status_pengajuan == 2)
                                Disetujui
                            @endif
                            
                        </span>

            <div class="table-responsive"><!-- Table with stripped rows -->        
                <table class="table caption-top bg-white px-2 ms-1">
                    <thead class="bg-white">
                        <tr>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">No</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">Nama</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">No rekening</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">Pokok</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">Hari</th>
                            <th colspan="2" class="text-center">Lembur</th>
                            <th colspan="2" class="text-center">Transport</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">Reimburse (IDR)</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">Potong Hutang (IDR)</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">biaya jabatan 5% (IDR)</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">Pph (IDR)</th>
                            <th rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">Total (IDR)</th>
                        </tr>
                        <tr>
                            <th width="5">Jam</th>
                            <th></th>
                            <th width="45"></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @if(!empty($listing_karyawan))
                        @foreach($listing_karyawan as $get_listing_karyawan)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $get_listing_karyawan->karyawan->nama_karyawan }}</td>
                            <td>{{ $get_listing_karyawan->karyawan->no_rekening }}</td>
                            <td class="text-right">{{ number_format($get_listing_karyawan->gaji_pokok) }}</td>
                            <td class="text-right">
                                @if($get_listing_karyawan->status_karyawan == 0)
                                {{ $get_listing_karyawan->jumlah_hari }}
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-right">{{ $get_listing_karyawan->jumlah_lembur }}</td>
                            <td class="text-right">
                            @if($get_listing_karyawan->status_karyawan == 0)    
                                            @php
                                            
                                                
                                                $gaji_pokok = $get_listing_karyawan->gaji_pokok;
                                                $jumlah_lembur = $get_listing_karyawan->jumlah_lembur;
                                                $total_lembur = ($gaji_pokok / 8) * $jumlah_lembur;

                                                echo number_format($total_lembur);
                                            @endphp
                                            @endif
                            @if($get_listing_karyawan->status_karyawan == 1)    
                                            @php
                                                
                                                 $gaji_pokok = $get_listing_karyawan->gaji_pokok;
                                                $upah_per_jam = $gaji_pokok * (1 / 173);
                                                $uang_lembur_jam_pertama = 1.5 * $upah_per_jam;
                                                $uang_lembur_jam_selanjutnya = 2 * $upah_per_jam;
                                                $jumlah_lembur = $get_listing_karyawan->jumlah_lembur;

                                                $total_upah_lembur = $uang_lembur_jam_pertama + $uang_lembur_jam_selanjutnya * ($jumlah_lembur - 1);
                                                echo number_format($total_upah_lembur)
                                            @endphp
                                            @endif
                            </td>
                            <td></td>
                            <td class="text-right">{{ number_format($get_listing_karyawan->nominal_transport) }}</td>
                            <td class="text-right">{{ number_format($get_listing_karyawan->nominal_rembes) }}</td>
                            <td class="text-right">{{ number_format($hutangPerKaryawan[$get_listing_karyawan->id_karyawan]) }}</td>  
                            @if($get_listing_karyawan->status_karyawan == 1)     
                            <td class="text-right">@php
                                            $jabatan = 0.05;
                                            $gajiPokok = $get_listing_karyawan->gaji_pokok;
                                            $biaya_jabatan = $gajiPokok * $jabatan;
                                                    
                                            echo   number_format($biaya_jabatan);
                                            @endphp</td>
                            @endif
                            @if($get_listing_karyawan->status_karyawan == 0)     
                            <td class="text-right"> - </td>
                            @endif
                            

                            <td class="text-right ">
                            @php
                                                // Perhitungan potongan pajak PPh 21
                                                    $gajiPokok = $get_listing_karyawan->gaji_pokok;
                                                    $jumlahHariKerja =$get_listing_karyawan->jumlah_hari;
                                                    $total = $gajiPokok;
                                                    $sub_total = $total + $total_upah_lembur + $get_listing_karyawan->nominal_rembes + $get_listing_karyawan->nominal_transport;

                                                    // Penghasilan Tidak Kena Pajak (PTKP)
                                                    $ptkp = 54000000;
                                                    $statusPernikahan = $get_listing_karyawan->karyawan->status_pernikahan; 

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
                                                    $jabatan = 0.05;
                                                    $gajiPokok = $get_listing_karyawan->gaji_pokok;
                                                    $biaya_jabatan = $gajiPokok * $jabatan;
                                                    $gaji_total_bulan = $sub_total - $hutangPerKaryawan[$get_listing_karyawan->id_karyawan] - $biaya_jabatan;
                                            
                                            
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

                                                    echo  number_format($potonganPPhBulanan, 0, ',', '.');

                                                @endphp


                            </td>
                            <td class="text-right total">
                            @if($get_listing_karyawan->status_karyawan == 1)   
                            @php 
                                    $gaji_pokok = $get_listing_karyawan->gaji_pokok;
                                    $jumlah_hari = $get_listing_karyawan->jumlah_hari;

                                    $total = $gaji_pokok;

                                    $sub_total = $total + $total_upah_lembur + $get_listing_karyawan->nominal_rembes + $get_listing_karyawan->nominal_transport;
                                    echo  number_format($gaji_total_bulan  - $potonganPPhBulanan)
                                @endphp
                                @endif
                                @if($get_listing_karyawan->status_karyawan == 0)   
                            @php 
                                    $gaji_pokok = $get_listing_karyawan->gaji_pokok;
                                    $jumlah_hari = $get_listing_karyawan->jumlah_hari;

                                    $total = $gaji_pokok * $jumlah_hari;

                                    $sub_total = $total + $total_lembur + $get_listing_karyawan->nominal_rembes + $get_listing_karyawan->nominal_transport;
                                    echo  number_format($sub_total - $hutangPerKaryawan[$get_listing_karyawan->id_karyawan])
                                @endphp
                                @endif
                            </td>
                            <td class="d-none total">
                            @if($get_listing_karyawan->status_karyawan == 0)
                            @php 
                                    $gaji_pokok = $get_listing_karyawan->gaji_pokok;
                                    $jumlah_hari = $get_listing_karyawan->jumlah_hari;

                                    $total = $gaji_pokok * $jumlah_hari;

                                    $sub_total = $total + $total_lembur + $get_listing_karyawan->nominal_rembes + $get_listing_karyawan->nominal_transport;
                                    echo $sub_total - $hutangPerKaryawan[$get_listing_karyawan->id_karyawan];
                            @endphp
                            @endif
                            @if($get_listing_karyawan->status_karyawan == 1)
                            @php 
                                    $gaji_pokok = $get_listing_karyawan->gaji_pokok;
                                    $jumlah_hari = $get_listing_karyawan->jumlah_hari;

                                    $total = $gaji_pokok;
                                    $sub_total = $total + $total_upah_lembur + $get_listing_karyawan->nominal_rembes + $get_listing_karyawan->nominal_transport;
                                    echo $sub_total - $hutangPerKaryawan[$get_listing_karyawan->id_karyawan] - $potonganPPhBulanan - $biaya_jabatan;
                            @endphp
                            
                             @endif
                                
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan="2"></td>
                            <td></td>
                            <td></td>
                            <td class="text-right"></td>
                            <td></td>
                            <td></td>
                            
                            <td></td>
                            <td class="text-right"></td>
                            <td colspan="2" class="text-center fw-bold">TOTAL</td>
                            <td class="text-right fw-bold" id="grand_total" >
                          
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    
    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        var cells = document.getElementsByClassName("total");

        var total = 0;
        for (var i = 0; i < cells.length; i++) {
            var cellValue = parseInt(cells[i].textContent);
            total += cellValue;
        }

        var formatted = total.toLocaleString("id-ID").replace(/\./g, ',');;

        var element_grand_total = document.getElementById('grand_total').innerHTML = formatted;
    </script>
@endsection