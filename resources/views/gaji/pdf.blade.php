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
                                        <td class="left"></td>

                                        <td class="right">
                                            @php
                                            $gaji_pokok = $karyawan->gaji_pokok;
                                            $jumlah_hari = $karyawan->jumlah_hari;

                                            $total = $gaji_pokok * $jumlah_hari;

                                            echo 'Rp'.number_format($total);
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center">1</td>
                                        <td class="left strong">Lembur</td>
                                        <td class="left">{{ $karyawan->jumlah_lembur }} jam </td>

                                        <td class="right">
                                        @if($karyawan->status_karyawan == 0)    
                                            @php
                                                
                                                $gaji_pokok = $karyawan->gaji_pokok;
                                                $jumlah_lembur = $karyawan->jumlah_lembur;
                                                $jumlah_hari_kerja = $karyawan->jumlah_hari;
                                                $upah_sejam = (1 / 173 ) * $gaji_pokok;

                                                $total_lembur = (($upah_sejam * (1.5 + ($jumlah_lembur - 1))) + ($upah_sejam * $jumlah_lembur)) * $jumlah_lembur;

                                                echo 'Rp. '.number_format($total_lembur * $jumlah_hari_kerja);
                                            @endphp
                                            @endif
                                            @if($karyawan->status_karyawan == 1)    
                                            @php
                                                
                                                 $gaji_pokok = $karyawan->gaji_pokok;
                                                $upah_per_jam = $gaji_pokok * (1 / 173);
                                                $uang_lembur_jam_pertama = 1.5 * $upah_per_jam;
                                                $uang_lembur_jam_selanjutnya = 2 * $upah_per_jam;
                                                $jumlah_lembur = $karyawan->jumlah_lembur;

                                                $total_upah_lembur = ($uang_lembur_jam_pertama + $uang_lembur_jam_selanjutnya * ($jumlah_lembur - 1)) * $jumlah_lembur;
                                                echo 'Rp. '.number_format($total_upah_lembur)
                                            @endphp
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center">2</td>
                                        <td class="left strong">Hutang/Kasbon</td>
                                        <td class="left"></td>

                                        <td class="right">Rp. {{ number_format($karyawan->nominal_hutang) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="center">3</td>
                                        <td class="left strong">Rembes</td>
                                        <td class="left"></td>

                                        
                                        <td class="right">Rp. {{ number_format($karyawan->nominal_rembes) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="center">4</td>
                                        <td class="left strong">Transport</td>
                                        <td class="left"></td>

                                        
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
                                                    echo 'Rp. '.number_format($sub_total);
                                                @endphp
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong>Potongan(Hutang)</strong>
                                            </td>
                                            <td class="right text-danger">-Rp{{ number_format($karyawan->nominal_hutang) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong>Total Diterima</strong>
                                            </td>
                                            <td class="right">
                                                <strong>Rp. {{ number_format($sub_total - $karyawan->nominal_hutang) }}</strong>
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
