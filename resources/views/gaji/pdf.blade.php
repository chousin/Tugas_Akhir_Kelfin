<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Slip Gaji</title>
    <style>
        /* Style CSS untuk tampilan slip gaji */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 20px;
}

h1 {
  text-align: center;
}

.card {
  background-color: #f5f5f5;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  padding: 20px;
}

.card-header {
  background-color: #e9e9e9;
  border-radius: 5px 5px 0 0;
  font-weight: bold;
  padding: 10px;
}

.table {
  width: 100%;
}

.table th,
.table td {
  padding: 8px;
}

.table th {
  background-color: #e9e9e9;
  font-weight: bold;
  text-align: left;
}

.table td.center {
  text-align: center;
}

.table td.left {
  text-align: left;
}

.table td.right {
  text-align: right;
}

.table-striped tbody tr:nth-of-type(odd) {
  background-color: #f9f9f9;
}

.table-clear {
  width: 100%;
  margin-top: 20px;
}

.table-clear td {
  padding: 5px;
  text-align: right;
}

.table-clear td.left {
  text-align: left;
}

.text-danger {
  color: #ff0000;
}

    </style>
</head>
<body>

        

    @if(!empty($listing_karyawan))
        @foreach($listing_karyawan as $karyawan)
            <div class="card">
            <h1>Slip Gaji</h1>
            <strong>Periode : {{ $pengajuan_penggajian->periode_start.' s/d '.$pengajuan_penggajian->periode_end }}</strong>      
                <div class="card-header">
                    Nama Karyawan: {{ $karyawan->karyawan->nama_karyawan }} <br>
                    No Rekening: {{ $karyawan->karyawan->no_rekening }}<br>
                    
                </div>
                
                   
                <div class="card-body">
                    
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
                                            <td class="left">
                                                <strong>Potongan(Hutang)</strong>
                                            </td>
                                            
                                            <td class="text-right text-danger">
                                            @php
                                            echo '-Rp' . number_format($karyawan->nominal_hutang);
                                            @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong>biaya Jabatan (5%)</strong>
                                            </td>
                                            
                                            <td class="text-right text-danger">
                                            @php
                                            $jabatan = 0.05;
                                            $gajiPokok = $karyawan->gaji_pokok;
                                            $biaya_jabatan = $gajiPokok * $jabatan;
                                                    
                                            echo  '-Rp' . number_format($biaya_jabatan);
                                            @endphp
                                            </td>
                                        </tr>
                                        
                                            <td class="left">
                                                <strong>Total </strong>
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
                                </table>
                            </div>

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
        @endforeach
    @endif

    <!-- ... -->

</body>
</html>
