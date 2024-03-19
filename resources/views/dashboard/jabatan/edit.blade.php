@foreach ($jabatan as $item)
    <!-- Modal -->
<div class="modal fade" id="editjabatan-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Jabatan</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/dashboard/data-jabatan/{{ $item->id }}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <main class="form-signin w-100 m-auto">
                    @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="n_jabatan">Nama Jabatan</label>
                            <input type="text" class="form-control @error('n_jabatan') is-invalid @enderror" name="n_jabatan" id="n_jabatan" required autofocus value="{{ old('n_jabatan', $item->n_jabatan) }}">
                            @error('n_jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
@endforeach