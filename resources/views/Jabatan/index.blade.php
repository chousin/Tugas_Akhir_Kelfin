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
              <h5 class="card-title">Data Jabatan</h5>
              <div id="delete_akun_alert"></div>
              <button type="button" class="btn btn-primary btn-tambah" data-toggle="modal" data-target="#jabatanTambah">
                Tambah Data
              </button>
              
              

               <div class="table-responsive"><!-- Table with stripped rows -->
                  <table class="table caption-top" >
                    <thead>
                      <tr >
                        <th scope="col">No</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Gaji Pokok</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                    @php $no = 1; @endphp
                    @foreach ($data as $jabatan)
                      
                    <tr class ="lead">
                        <th scope="row">{{$no++}}</th>
                        <td >{{$jabatan->karyawan->nama_karyawan}}</td>
                        <td>{{$jabatan->jabatan}}</td>
                        <td>{{$jabatan->gaji_pokok}}</td>
                        <td>
                        <button type="button" class="btn btn-primary btn-edit"
                                data-url={{ route('jabatan.getJabatan', ['id' => $jabatan->id]) }} data-toggle="modal"
                                data-target="#editJabatan">
                                Edit
                            </button>
                            <a class="btn btn-danger btn-delete"
                                href="{{ route('jabatan.delete', ['id' => $jabatan->id]) }}"
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

    @include('jabatan.tambah_data_jabatan')


    @include('jabatan.edit_data_jabatan')
    

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
    $('#editJabatan #id_karyawan').val('')
    $('#editJabatan #jabatan').val('')
    $('#editJabatan #gaji_pokok').val('')

    $.ajax({
      type: "get",
      url: url,
      dataType: "json",
      success: function(res) {
        // Menghapus semua opsi sebelumnya
        $('#editJabatan #id_karyawan').empty();

        // Menambahkan opsi "Pilih Nama Karyawan" sebagai opsi pertama
        $('#editJabatan #id_karyawan').append('<option value="">Pilih Nama Karyawan</option>');

        // Loop melalui setiap karyawan dan tambahkan sebagai opsi dropdown
        $.each(res.karyawan, function(index, karyawan) { 
          // console.log(karyawan);
          $('#editJabatan #id_karyawan').append('<option value="' + karyawan.id_karyawan + '">' + karyawan.nama_karyawan + '</option>');
        });

        

        // Mengatur nilai pada input lainnya
        $('#editJabatan #id_karyawan').val(res.jabatan['id_karyawan']); // Berubah
        $('#editJabatan #jabatan').val(res.jabatan['jabatan']); 
        $('#editJabatan #gaji_pokok').val(res.jabatan['gaji_pokok']); 
      }
    });
  });

  

</script>


<!-- End Edit Data -->
  @endsection

  

  