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
              <h5 class="card-title">Data Transport</h5>
              <div id="delete_akun_alert"></div>
              <button type="button" class="btn btn-primary btn-tambah" data-toggle="modal" data-target="#transportTambah">
                Tambah Data
              </button>
              
              

               <div class="table-responsive"><!-- Table with stripped rows -->
                  <table class="table caption-top" >
                    <thead>
                      <tr >
                        <th scope="col">No</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Jenis Bensin Produk</th>
                        <th scope="col">Liter Volume</th>
                        <th scope="col">Harga Liter</th>
                        <th scope="col">Total</th>
                        <th scope="col">Bukti Struk</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                      @php $no = 1; @endphp
                    @foreach ($data as $transport)
                    <tr class ="lead">
                        <th scope="row">{{$no++}}</th>
                        <td >{{$transport->karyawan->nama_karyawan}}</td>
                        <td>{{$transport->jenis_bensin_produk}}</td>
                        <td>{{$transport->liter_volume}}</td>
                        <td>{{number_format($transport->harga_liter)}}</td>
                        <td>{{number_format($transport->total)}}</td>
                        <td>{{$transport->bukti_struk}}</td>
                        <td>
                        <button type="button" class="btn btn-primary btn-edit"
                                data-url={{ route('transport.getTransport', ['id' => $transport->id]) }} data-toggle="modal"
                                data-target="#editTransport">
                                Edit
                            </button>
                            <a class="btn btn-danger btn-delete"
                                href="{{ route('transport.delete', ['id' => $transport->id]) }}"
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

    @include('transport.tambah_data_transport')


    @include('transport.edit_data_transport')
    

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
            console.log(res.transport);

            // Mengisi nilai pada input
            $('#editTransport #id_transport').val(res.transport['id']);
            $('#editTransport #id_karyawan').val(res.transport['id_karyawan']);
            $('#editTransport #jenis_bensin_produk').val(res.transport['jenis_bensin_produk']);
            $('#editTransport #liter_volume').val(res.transport['liter_volume']);
            $('#editTransport #harga_liter').val(res.transport['harga_liter']);

            // Menampilkan gambar bukti struk
            if (res.transport['bukti_struk']) {
                var imageUrl = "{{ asset('images_bukti_nota_bensin') }}/" + res.transport['bukti_struk'];
                $('#editTransport #bukti_struk_preview').attr('src', imageUrl);
                $('#editTransport #bukti_struk_preview').show();
            } else {
                $('#editTransport #bukti_struk_preview').hide();
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

  

  