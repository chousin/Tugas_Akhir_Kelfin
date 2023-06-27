<div class="modal fade" id="KaryawanTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Karyawan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card" id="tambah_akun">
            <div class="card-body">
              <h5 class="card-title">Tambah Data</h5>

              <!-- Vertical Form -->
              <form class="row g-3" action="/karyawan" method="post">
                @csrf
                <div class="col-12">
                  <label  class="form-label">Nama Karyawan</label>
                  <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control @error('nama_karyawan') is-invalid @enderror" id="name">
                  @error('nama_karyawan')
                  <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="col-12">
                  <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-12">
                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name ="alamat" style="height: 100px"></textarea>
                    @error('alamat')
                  <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                </div>
                <div class="col-12">
                  <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                  <div class="col-sm-12">
                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror">
                    @error('tgl_lahir')
                  <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                </div>
                  <fieldset class="col-12">
                  <legend class="col-form-label col-sm-3 pt-0">Jenis Kelamin</legend>
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenkel" value="laki-laki" checked>
                      <label class="form-check-label" for="gridRadios1">
                        Laki-Laki
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenkel" value="perempuan">
                      <label class="form-check-label" for="gridRadios2">
                        Perempuan
                      </label>
                    </div>
                  </div>
                    </fieldset>
                    <div class="col-12">
                  <label  class="form-label">No Hp</label>
                  <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="name">
                  @error('no_hp')
                  <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="col-12">
                  <label  class="form-label">No Ktp</label>
                  <input type="text" name="no_ktp" id="no_ktp" class="form-control @error('no_ktp') is-invalid @enderror" id="name">
                  @error('name')
                  <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                
                <div class="col-12">
                  <label  class="form-label">No Rekening</label>
                  <input type="text" name="no_rekening"  id="no_rekening" class="form-control @error('no_rekening') is-invalid @enderror" id="name">
                  @error('no_rekening')
                  <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary add_akun">Tambah Data</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- End Tambah Data -->
