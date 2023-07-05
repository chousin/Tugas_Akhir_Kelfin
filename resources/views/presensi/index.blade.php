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
                                    <th>No KTP</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @if(!empty($karyawan))
                                @foreach($karyawan as $get_karyawan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $get_karyawan->no_ktp }}</td>
                                    <td>{{ $get_karyawan->nama_karyawan }}</td>
                                    <td>{{ $get_karyawan->jenis_kelamin }}</td>
                                    <td>
                                        <a href="{{ url('/presensi/'.$get_karyawan->id_karyawan) }}" class="btn btn-primary">Detail</a>
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