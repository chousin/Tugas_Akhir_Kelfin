@extends('layouts.main')

@section('container')

<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card" >
            <div class="card-body">
              @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible fade show " row="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              <h5 class="card-title">Data Rembes</h5>
              <div id="delete_akun_alert"></div>
              <button type="button" class="btn btn-primary btn-tambah" data-toggle="modal" data-target="#rembesTambah">
                Tambah Data
              </button>
              
              

               <div class="table-responsive"><!-- Table with stripped rows -->
                  <table class="table caption-top" >
                    <thead>
                      <tr >
                        <th scope="col">No</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Nominal</th>
                        <th scope="col">Bukti Nota</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($data as $rembes)
                    <tr class ="lead">
                        <th scope="row">{{$no++}}</th>
                        <td >{{$rembes->karyawan->nama_karyawan}}</td>
                        <td>{{number_format($rembes->nominal)}}</td>
                        <td>{{$rembes->bukti_nota}}</td>
                        <td>
                        <button type="button" class="btn btn-primary btn-edit"
                                data-url={{ route('rembes.getRembes', ['id' => $rembes->id]) }} data-toggle="modal"
                                data-target="#editRembes">
                                Edit
                            </button>
                            <a class="btn btn-danger btn-delete"
                                href="{{ route('rembes.delete', ['id' => $rembes->id]) }}"
                                onclick="return confirm('Apa kamu yakin?')">Delete</a>
                        </td>
                      </tr>
                    @endforeach  
                      
                    </tbody>
                  </table>
                </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- Button trigger modal -->

    @include('rembes.tambah_data_rembes')


    @include('rembes.edit_data_rembes')
    

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script>
     $('.btn-edit').click(function() {
    var url = $(this).data('url');
    console.log(url);

    $.ajax({
        type: "get",
        url: url,
        dataType: "json",
        success: function(res) {
            console.log(res.rembes);

            // Mengisi nilai pada input
            $('#editRembes #id_rembes').val(res.rembes['id']);
            $('#editRembes #id_karyawan').val(res.rembes['id_karyawan']);
            $('#editRembes #nominal').val(res.rembes['nominal']);

            // Menampilkan gambar bukti nota
            if (res.rembes['bukti_nota']) {
                var imageUrl = "{{ asset('images_bukti_nota') }}/" + res.rembes['bukti_nota'];
                $('#editRembes #bukti_nota_preview').attr('src', imageUrl);
                $('#editRembes #bukti_nota_preview').show();
            } else {
                $('#editRembes #bukti_nota_preview').hide();
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
});


    </script>
<!-- End Edit Data -->
  @endsection

  

  