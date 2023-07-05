<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi Karyawan</title>
    <script src="{{ asset('js/geo.js') }}" type="text/javascript" charset="utf-8"></script>
</head>
<body>
    <b>Mohon tunggu, halaman sedang di alihkan ke lokasi karyawan</b>
    <input type="hidden" id="latitude" value="{{ $presensi->latitude }}">
    <input type="hidden" id="longitude "value="{{ $presensi->longitude }}">
	<script>
		function success_callback()
		{
            var latitude = document.getElementById('latitude').value;
            var longitude = document.getElementById('longitude ').value;

			geo_position_js.showMap(latitude, longitude);
		}
		
		function error_callback(p)
		{
			alert('error='+p.message);
		}	
        
        success_callback();
	</script>
</body>
</html>