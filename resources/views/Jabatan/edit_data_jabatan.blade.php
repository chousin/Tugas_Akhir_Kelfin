
<div class="modal fade" id="editJabatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Jabatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card" id="tambah_akun">
            <div class="card-body">
              <h5 class="card-title">Edit Data</h5>

              <!-- Vertical Form -->
              <form class="row g-3" action="{{ route('jabatan.update', ['id' => $jabatan->id]) }}" method="post">
                @csrf
                
                <div class="col-12">
                    <label class="form-label">Nama Karyawan</label>
                    <select name="id_karyawan" id="id_karyawan" class="form-control @error('id_karyawan') is-invalid @enderror">
                        <option value="">Pilih Nama Karyawan</option>
                    </select>
                    @error('id_karyawan')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                

                <div class="col-12">
                        <label  class="form-label">Jabatan</label>
                         <input type="text" name="jabatan" id="jabatan"  class="form-control @error('jabatan') is-invalid @enderror" >
                        @error('jabatan')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                         {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label  class="form-label">Gaji Pokok</label>
                         <input type="text" name="gaji_pokok" id="gaji_pokok" class="form-control @error('gaji_pokok') is-invalid @enderror">
                        @error('gaji_pokok')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                         {{ $message }}
                            </div>
                        @enderror
                    </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary add_akun">Ubah Data</button>
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

