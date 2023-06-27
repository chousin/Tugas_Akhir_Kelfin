<!-- Modal Edit Data -->
<div class="modal fade" id="editAkun" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Akun</h5>
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
              <h5 class="card-title">Ubah Akun</h5>

              <!-- Vertical Form -->
              <form class="row g-3" action="{{route('akun.update')}}" method="post">
                @csrf
                <div class="col-12">
                  <input type="hidden" name="id" value="{{ $akun->id }}">
                  <label  class="form-label">Nama</label>
                  <input type="text" name="name" id="name"   class="form-control @error('name') is-invalid @enderror"
                   id="name" value="">
                  @error('name')
                  <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="col-12">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                  id="email" value="">
                  @error('email')
                  <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <!-- 
                <div class="col-12">
                  <label  class="form-label">Password</label>
                  <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" 
                  id="password" value="{{$akun->password}}">
                  @error('password')
                  <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                -->
                <div class="col-12">
                <label >Role</label>
                <select name="role" class="form-select" id="role" aria-label="State">
                      <option selected value="admin">Admin</option>
                      <option value="hrd">Hrd</option>
                      <option value="pegawai">Pegawai</option>
                      <option value="pimpinan">Pimpinan</option>  
                    </select>

                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Ubah</button>
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
