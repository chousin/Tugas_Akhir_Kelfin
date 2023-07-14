<div class="modal fade" id="addAkunModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Akun</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card" id="tambah_akun">
            <div class="card-body">
              @if(session()->has('success'))
              <div class="alert alert-succes alert-dismissible fade show" row="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              <h5 class="card-title">Tambah Akun</h5>

              <!-- Vertical Form -->
              <form class="row g-3" action="/akun" method="post">
                @csrf
                <div class="col-12">
                  <label  class="form-label">Nama</label>
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                  @error('name')
                  <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="col-12">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" >
                  @error('email')
                  <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="col-12">
                  <label  class="form-label">Password</label>
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                  @error('password')
                  <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="col-12">
                <label >Role</label>
                <select name="role" class="form-select" id="role" aria-label="State">
                      <option selected value="admin">Admin</option>
                      <option value="hrd">Hrd</option>
                      <option value="pegawai">Pegawai</option>
                      <option value="pimpinan">Pimpinan</option>
                      <option value="keuangan">Manajer Keuangan</option>  
                    </select>

                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary add_akun">Submit</button>
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
