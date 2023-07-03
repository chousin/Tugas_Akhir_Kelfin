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
              <h5 class="card-title">Data Karyawan</h5>
              <div id="delete_akun_alert"></div>
              <button type="button" class="btn btn-primary btn-tambah" data-toggle="modal" data-target="#KaryawanTambah">
                Tambah Data
              </button>
              
              

               <div class="table-responsive"><!-- Table with stripped rows -->
                  <table class="table caption-top" >
                    <thead>
                      <tr >
                        <th scope="col">No</th>
                        <th scope="col">Nama Karyawan</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">No Ktp</th>
                        <th scope="col">No Rekening</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($data as $karyawan)
                    <tr class ="lead">
                        <th scope="row">{{$no++}}</th>
                        <td >{{$karyawan->nama_karyawan}}</td>
                        <td>{{$karyawan->alamat}}</td>
                        <td>{{$karyawan->tgl_lahir}}</td>
                        <td>{{$karyawan->jenis_kelamin}}</td>
                        <td>{{$karyawan->no_hp}}</td>
                        <td>{{$karyawan->no_ktp}}</td>
                        <td>{{$karyawan->no_rekening}}</td>
                        <td>
                        <button type="button" class="btn btn-primary btn-edit"
                                data-url={{  route('karyawan.getKaryawan', ['id' => $karyawan->id_karyawan]) }} data-toggle="modal"
                                data-target="#editKaryawan">
                                Edit
                            </button>
                            <a class="btn btn-danger btn-delete"
                                href="{{ route('karyawan.delete', ['id' => $karyawan->id_karyawan]) }}"
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

    @include('karyawan.tambah_data_karyawan')


    @include('karyawan.edit_data_karyawan')
    

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
        $('#editKaryawan #nama_karyawan').val('')
        $('#editKaryawan #alamat').val('')
        $('#editKaryawan #tgl_lahir').val('')
        $('input[name="jenis_kelamin"]').prop('checked', false);
        $('#editKaryawan #no_hp').val('')
        $('#editKaryawan #no_ktp').val('')
        $('#editKaryawan #no_rekening').val('')
        $.ajax({
          type: "get",
          url: url,
          dataType: "json",
          success: function(res) {
            $('#editKaryawan #nama_karyawan').val(res['nama_karyawan'])
            $('#editKaryawan #alamat').val(res['alamat'])
            $('#editKaryawan #tgl_lahir').val(res['tgl_lahir'])
            $('#editKaryawan input[name="jenis_kelamin"][value="' + res['jenis_kelamin'] + '"]').prop('checked', true);
            $('#editKaryawan #no_hp').val(res['no_hp'])
            $('#editKaryawan #no_ktp').val(res['no_ktp'])
            $('#editKaryawan #no_rekening').val(res['no_rekening'])

          }
        });
        
      });
    </script>
<!-- End Edit Data -->
  @endsection

  

  