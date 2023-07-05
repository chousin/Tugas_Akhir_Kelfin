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
                            </div>
                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">#</th>
                                        <th>Item</th>
                                        <th>Description</th>

                                        <th class="right">Unit Cost</th>
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="center">1</td>
                                        <td class="left strong">Gaji Pokok</td>
                                        <td class="left">(Gaji Pokok * Jumlah Hari Kerja)</td>

                                        <td class="right">Rp{{ number_format($karyawan->gaji_pokok) }}</td>
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
                                        <td class="left">(Gaji Pokok : 8) x Jam </td>

                                        <td class="right">{{ $karyawan->jumlah_lembur }} Jam</td>
                                        <td class="right">
                                            @php
                                                $gaji_pokok = $karyawan->gaji_pokok;
                                                $jumlah_hari = $karyawan->jumlah_hari;

                                                $total_lembur = $gaji_pokok / 8 * $jumlah_hari;

                                                echo 'Rp'.number_format($total_lembur);
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="center">2</td>
                                        <td class="left strong">Hutang/Kasbon</td>
                                        <td class="left"></td>

                                        <td class="right">Rp{{ number_format($karyawan->nominal_hutang) }}</td>
                                        <td class="right">Rp{{ number_format($karyawan->nominal_hutang) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="center">3</td>
                                        <td class="left strong">Rembes</td>
                                        <td class="left"></td>

                                        <td class="right">Rp{{ number_format($karyawan->nominal_rembes) }}</td>
                                        <td class="right">Rp{{ number_format($karyawan->nominal_rembes) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="center">4</td>
                                        <td class="left strong">Transport</td>
                                        <td class="left">(jumlah motor ke project x bensin)</td>

                                        <td class="right">Rp{{ number_format($karyawan->nominal_transport) }}</td>
                                        <td class="right">Rp{{ number_format($karyawan->nominal_transport) }}</td>
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
                                                @php
                                                    $sub_total = $total + $total_lembur + $karyawan->nominal_rembes + $karyawan->nominal_transport;
                                                    echo 'Rp'.number_format($sub_total);
                                                @endphp
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
                                                <strong>Rp{{ number_format($sub_total - $karyawan->nominal_hutang) }}</strong>
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