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
              <h5 class="card-title">Data Hutang</h5>
              <div id="delete_akun_alert"></div>
              <button type="button" class="btn btn-primary btn-tambah" data-toggle="modal" data-target="#hutangTambah">
                Tambah Data
              </button>
              
              

               <div class="table-responsive"><!-- Table with stripped rows -->
                  <table class="table caption-top" >
                    <thead>
                      <tr >
                        <th scope="col">No</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Nominal Hutang</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                    @foreach ($data as $hutang)
                    <tr class ="lead">
                        <th scope="row">{{$hutang->id}}</th>
                        <td>{{$hutang->karyawan->nama_karyawan}}</td>
                        <td>{{$hutang->nominal_hutang}}</td>
                        <td>{{$hutang->keterangan}}</td>
                        <td>
                        <button type="button" class="btn btn-primary btn-edit"
                                data-url={{ route('hutang.getHutang', ['id' => $hutang->id]) }} data-toggle="modal"
                                data-target="#editHutang">
                                Edit
                            </button>
                            <a class="btn btn-danger btn-delete"
                                href="{{ route('hutang.delete', ['id' => $hutang->id]) }}"
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

    @include('hutang.tambah_data_hutang')


    @include('hutang.edit_data_hutang')
    

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
    $('#editHutang #id_karyawan').val('')
    $('#editHutang #nominal_hutang').val('')
    $('#editHutang #keterangan').val('')

    $.ajax({
      type: "get",
      url: url,
      dataType: "json",
      success: function(res) {

        console.log(res.karyawan);
        // Menghapus semua opsi sebelumnya
        $('#editHutang #id_karyawan').empty();

        // Menambahkan opsi "Pilih Nama Karyawan" sebagai opsi pertama
        $('#editHutang #id_karyawan').append('<option value="">Pilih Nama Karyawan</option>');

        // Loop melalui setiap karyawan dan tambahkan sebagai opsi dropdown
        $.each(res.karyawan, function(index, karyawan) { 
          // console.log(karyawan);
          $('#editHutang #id_karyawan').append('<option value="' + karyawan.id_karyawan + '">' + karyawan.nama_karyawan + '</option>');
        });

        

        // Mengatur nilai pada input lainnya
        $('#editHutang #id_karyawan').val(res.hutang['id_karyawan']); // Berubah
        $('#editHutang #nominal_hutang').val(res.hutang['nominal_hutang']); 
        $('#editHutang #keterangan').val(res.hutang['keterangan']); 
      }
    });
  });

    </script>
<!-- End Edit Data -->
  @endsection

  

  