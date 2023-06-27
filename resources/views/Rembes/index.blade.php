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
                    @foreach ($data as $rembes)
                    <tr class ="lead">
                        <th scope="row">{{$rembes->id}}</th>
                        <td >{{$rembes->karyawan->nama_karyawan}}</td>
                        <td>{{$rembes->nominal}}</td>
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
        $('#editTransport #nama_karyawan').val('')
        $('#editTransport #nominal').val('')
        $('#editTransport #bukti_nota').val('')
        
        $.ajax({
          type: "get",
          url: url,
          dataType: "json",
          success: function(res) {
            $('#editTransport #nama_karyawan').val(res['nama_karyawan'])
            $('#editTransport #nominal').val(res['nominal'])
            $('#editTransport #bukti_nota').val(res['bukti_nota'])
          }
        });
        
      });
    </script>
<!-- End Edit Data -->
  @endsection

  

  