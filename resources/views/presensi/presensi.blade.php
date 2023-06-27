@extends('layouts.main')

@section('container')


<form  method="POST" action="{{ url('/absen') }}">
                  @csrf
                  <input type="hidden" name="latitude" id="latitude">
                  <input type="hidden" name="longitude" id="longitude">
                  <input type="submit" value="ABSEN MASUK">
            </form>

            <form method="POST" action="{{ url('/absen-pulang') }}">
                  @csrf
                  <input type="hidden" name="latitude" id="latitude1">
                  <input type="hidden" name="longitude" id="longitude1">
                  <input type="submit" value="ABSEN PULANG">
            </form>
      </body>
      <script>
            function getLocation() {
                  if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition);
                  } else { 
                        x.innerHTML = "Geolocation is not supported by this browser.";
                  }
            }

            getLocation();

            function showPosition(position) {
                  document.getElementById('latitude').value = position.coords.latitude;
                  document.getElementById('longitude').value = position.coords.longitude;

                  document.getElementById('latitude1').value = position.coords.latitude;
                  document.getElementById('longitude1').value = position.coords.longitude;
            }
            </script>

@endsection