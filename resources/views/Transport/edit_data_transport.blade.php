<div class="modal fade" id="editTransport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Transport</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card" id="tambah_akun">
            <div class="card-body">
              <h5 class="card-title">Edit Data</h5>

              <!-- Vertical Form -->
              @if(isset($transport->id))
              <form class="row g-3" action="{{ route('transport.update', ['id' => $transport->id]) }}" method="post" enctype="multipart/form-data">
              @endif
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
                          echo '<option value="' . $karyawan->id_karyawan . '">' . $karyawan->nama_karyawan . '</option>';
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
                        <label  class="form-label">Jenis Bensin Produk</label>
                         <input type="text" name="jenis_bensin_produk" id="jenis_bensin_produk" class="form-control @error('jenis_bensin_produk') is-invalid @enderror">
                        @error('jenis_bensin_produk')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                         {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label  class="form-label">Liter Volume</label>
                         <input type="text" name="liter_volume" id="liter_volume" class="form-control @error('liter_volume') is-invalid @enderror">
                        @error('liter_volume')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                         {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label  class="form-label">Harga Liter</label>
                         <input type="text" name="harga_liter" id="harga_liter" class="form-control @error('harga_liter') is-invalid @enderror">
                        @error('harga_liter')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                         {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Bukti Struk</label>
                        <input type="file" name="bukti_struk" id="bukti_struk" class="form-control @error('bukti_struk') is-invalid @enderror">
                        <img id="bukti_struk_preview" style="margin-top :10px;" class="img-thumbnail">
                        @error('bukti_struk')
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
