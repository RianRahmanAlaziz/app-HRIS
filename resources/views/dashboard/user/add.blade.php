<!-- Modal -->
<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/dashboard/data-user-management" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <main class="form-signin w-100 m-auto">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" required autofocus value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required autofocus value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="level">Role</label>
                            <select class="form-select" name="level" >
                                
                                    <option value="Admin" selected>Admin</option>
                                    <option value="HRD">HRD</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required autofocus>

                        </div>
                </main>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-dark">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>