@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-3">
		@include('_partial.flash_message')
		@if(Session::get('sesi_absen') == '')
		<form  method="POST" action="{{ url('/absen') }}">
			@csrf
			<input type="hidden" name="latitude" id="latitude">
			<input type="hidden" name="longitude" id="longitude">
			<input type="submit" value="ABSEN MASUK" class="btn btn-primary">
		</form>
		@else
			@if($presensi->tanggal_pulang != $presensi->tanggal_masuk)
				<form method="POST" action="{{ url('/reset-absen') }}">
					@csrf
					<input type="submit" value="ATUR ULANG ABSEN" class="btn btn-warning">
				</form>
			@else
				<form method="POST" action="{{ url('/absen-pulang') }}">
					@csrf
					<input type="hidden" name="latitude" id="latitude">
					<input type="hidden" name="longitude" id="longitude">
					<input type="submit" value="ABSEN PULANG" class="btn btn-success">
				</form>
			@endif
		@endif
	</div>
	<div class="col">
		<table class="table table-striped">
			<tr>
				<th width="250">Nama Karyawan</th>
				<td width="5">:</td>
				<td>{{ isset($presensi) ? $presensi->karyawan->nama_karyawan : '-' }}</td>
			</tr>
			<tr>
				<th width="250">Absen Masuk</th>
				<td width="5">:</td>
				<td>{{ isset($presensi) ? $presensi->tanggal_masuk : '-' }}</td>
			</tr>
			<tr>
				<th width="250">Absen Pulang</th>
				<td width="5">:</td>
				<td>
					@if(isset($presensi))
						@if($presensi->tanggal_pulang != $presensi->tanggal_masuk)
							{{ $presensi->tanggal_pulang }}
						@else
							-
						@endif
					@endif
				</td>
			</tr>
			<tr>
				<th width="250">Jumlah Lembur</th>
				<td width="5">:</td>
				<td>{{ isset($presensi) ? $presensi->jumlah_lembur : '0' }} Jam</td>
			</tr>
		</table>
	</div>
</div>
<script>
if(geo_position_js.init()){
	geo_position_js.getCurrentPosition(success_callback,error_callback,{enableHighAccuracy:true});
}else{
	alert("Functionality not available");
}

function success_callback(p)
{
	document.getElementById('latitude').value = p.coords.latitude;
    document.getElementById('longitude').value = p.coords.longitude;
}

function error_callback(p)
{
	alert('error='+p.message);
}	
</script>
@endsection