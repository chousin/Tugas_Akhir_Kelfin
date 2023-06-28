<div class="modal fade" id="editRembes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Rembes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card" id="tambah_akun">
            <div class="card-body">
              <h5 class="card-title">Tambah Data</h5>

              <!-- Vertical Form -->
              <form class="row g-3" action="{{ route('rembes.update', ['id' => $rembes->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="col-12">
                    <label class="form-label">Nama Karyawan</label>
                    <select name="id_karyawan" id="id_karyawan" class="form-control @error('id_karyawan') is-invalid @enderror">
                      <option value="">Pilih Nama Karyawan</option>
                      <?php
                        // Ambil data karyawan dari tabel "employees" atau tabel relasi lainnya
                        $employees = DB::table('karyawans')->get();

                        // Loop melalui setiap karyawan dan tambahkan sebagai opsi dropdown
                        foreach ($employees as $karyawan) {
                          echo '<option value="' . $karyawan->id . '">' . $karyawan->nama_karyawan . '</option>';
                        }
                      ?>
                    </select>
                    @error('nama_karyawan')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                

                <div class="col-12">
                        <label  class="form-label">Nominal</label>
                         <input type="text" name="nominal" id="nominal" class="form-control @error('nominal') is-invalid @enderror">
                        @error('nominal')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                         {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Bukti Nota</label>
                        <input type="file" name="bukti_nota" id="bukti_nota" class="form-control @error('bukti_nota') is-invalid @enderror">
                        <img id="bukti_nota_preview" style="margin-top :10px;" class="img-thumbnail">
                        @error('bukti_nota')
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
