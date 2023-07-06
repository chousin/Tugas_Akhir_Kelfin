@extends('layouts.main')

@section('container')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table caption-top">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>HRD(Pengajuan)</th>
                                    <th>Tanggal Mulai Absen</th>
                                    <th>Tanggal Akhir Absen</th>
                                    <th>Keterangan</th>
                                    <th>Status Pengajuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @if(!empty($pengajuan_penggajian))
                                @foreach($pengajuan_penggajian as $penggajian)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $penggajian->created_at }}</td>
                                    <td>{{ $penggajian->user->name }}</td>
                                    <td>{{ $penggajian->periode_start }}</td>
                                    <td>{{ $penggajian->periode_end }}</td>
                                    <td>{{ $penggajian->keterangan }}</td>
                                    <td>
                                        @if($penggajian->status_pengajuan == 1)
                                        <span class="badge text-bg-warning">Sedang Direview</span>
                                        @endif

                                        @if($penggajian->status_pengajuan == 2)
                                        <span class="badge text-bg-success">Disetujui</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/detail-penggajian/'.$penggajian->id) }}" class="btn btn-info">Detail</a>
                                        @if(Auth::user()->role == 'pimpinan')
                                            @if($penggajian->status_pengajuan != 2)
                                            <a href="{{ url('/detail-penggajian/'.$penggajian->id.'/approve') }}" class="btn btn-success">Setujui</a>
                                            @endif
                                        @endif

                                        @if(Auth::user()->role == 'admin')
                                            @if($penggajian->status_pengajuan != 1)
                                            <a href="{{ url('/detail-penggajian/'.$penggajian->id.'/cetak') }}" target="_blank" class="btn btn-success">Cetak</a>
                                            @endif
                                        @endif
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