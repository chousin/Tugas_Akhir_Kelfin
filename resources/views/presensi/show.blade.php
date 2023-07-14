@extends('layouts.main')

@section('container')
@if(!empty($presensi))
    @foreach($presensi as $get_presensi)
        <h3>Absen {{$get_presensi->karyawan->nama_karyawan}}</h3>
        <h3>Jumlah Absen Masuk : {{$JumlahAbsen}}</h3>
        
        @php
        break;
        @endphp

    @endforeach
@endif
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table caption-top">
                            <thead>
                                <tr>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Pulang</th>
                                    <th>Lembur</th>
                                    <th>Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($presensi))
                                    @foreach($presensi as $get_presensi)
                                    <tr>
                                        <td>{{ $get_presensi->tanggal_masuk }}</td>
                                        <td>
                                            @if($get_presensi->tanggal_pulang != $get_presensi->tanggal_masuk)
                                                {{ $get_presensi->tanggal_pulang }}
                                            @else
                                                <span class="badge text-bg-warning">Belum Absen Pulang</span>
                                            @endif
                                        </td>
                                        <td>{{ $get_presensi->jumlah_lembur }}</td>
                                        <td>
                                            <a href="{{ url('/presensi/'.$get_presensi->id.'/lokasi') }}" target="_blank" class="btn btn-info">Lihat Lokasi</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection