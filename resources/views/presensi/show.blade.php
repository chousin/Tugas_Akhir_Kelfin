@extends('layouts.main')

@section('container')
<!--<form action="" method="get">
    <label for="bulan">Pilih Bulan:</label>
    <select name="bulan" id="bulan">
        <option value="1">Januari</option>
        <option value="2">Februari</option>
        <option value="3">Maret</option>
        <option value="4">April</option>
        <option value="5">Mei</option>
        <option value="6">Juni</option>
        <option value="7">Juli</option>
        <option value="8">Agustus</option>
        <option value="9">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Februari</option>
        
        
    </select>
    <button type="submit">Tampilkan</button>
</form>
 Tambahkan pilihan bulan lainnya sesuai dengan kebutuhan -->
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
                                    <th>Aksi</th>
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
                                                <a href="{{ url('/pulang-presensi/'.$get_presensi->id.'/'.$get_presensi->id_karyawan) }}" class="btn btn-warning">Absen Pulang</a>
                                            @endif
                                        </td>
                                        <td>{{ $get_presensi->jumlah_lembur }}</td>
                                        <td>
                                            <a href="{{ url('/presensi/'.$get_presensi->id.'/lokasi') }}" target="_blank" class="btn btn-info">Lihat Lokasi</a>
                                        </td>
                                        <td>
                                             <a href="#"  onclick=" return batalkanAbsen({{ $get_presensi->id }}, {{ $id_karyawan}});" class="btn btn-danger">Batalkan Absen</a>

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
<script>
    function batalkanAbsen(id, id_karyawan) {
        var kataKunci = prompt("Untuk membatalkan absen, silakan ketik 'batalkan absen'.");
        console.log(id)
        if (kataKunci === "batalkan absen") {
            
            window.location.href = '{{ url("/presensi/") }}' + '/' + id + '/batalkan/'+id_karyawan  ;
        } else {
            alert("Kata kunci salah. Absen tidak dibatalkan.");
        }
    }
</script>
