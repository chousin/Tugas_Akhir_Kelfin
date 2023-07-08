@extends('layouts.main')

@section('container')

<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible fade show " row="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              <h5 class="card-title">Data Akun</h5>
              <div id="delete_akun_alert"></div>
              <button type="button" data-bs-toggle="modal" data-bs-target="#addAkunModal"  onClick="create()" class="btn btn-primary ms-auto " >Tambah Akun</button>
              
              

              <!-- Table with stripped rows -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                
                <tbody>
                  @php $no = 1; @endphp
                @foreach ($data as $akun)
                <tr class="lead">
                    <th scope="row">{{$no++}}</th>
                    <td>{{$akun->name}}</td>
                    <td>{{$akun->email}}</td>
                    <td>{{$akun->role}}</td>
                    <td>
                          <button type="button" class="btn btn-primary btn-edit"
                              data-url="{{  route('akun.getAkun', ['id' => $akun->id]) }}" data-toggle="modal"
                              data-target="#editAkun">
                              Edit
                          </button>
                            <!-- <a class="btn btn-danger btn-delete"
                                href="{{ route('akun.delete', ['id' => $akun->id]) }}"
                                onclick="return confirm('Apa kamu yakin?')">Delete</a> -->
                    </td>
                  </tr>
                @endforeach  
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- Button trigger modal -->

<!-- Modal Tambah Data -->
@include('akun.tambah_akun')
<!-- End Tambah Data -->

<!-- Modal Edit Data -->
@include('akun.edit_akun')
<!-- End Edit Data -->

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
        $('#editAkun #name').val('')
        $('#editAkun #email').val('')
        $('#editAkun #role').val('')
        console.log(url);
        $.ajax({
          type: "get",
          url: url,
          dataType: "json",
          success: function(res) {
            $('#editAkun #name').val(res['name'])
            $('#editAkun #email').val(res['email'])
            $('#editAkun #role').val(res['role'])

          }
        });
        
      });
</script>

<!-- End Edit Data -->
  @endsection