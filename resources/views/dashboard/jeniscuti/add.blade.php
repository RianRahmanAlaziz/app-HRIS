<!-- Modal -->
<div class="modal fade" id="addjabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Jenis Cuti</h5>
            </div>
            <form action="/dashboard/admin/data-jenis-cuti" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <main class="form-signin w-100 m-auto">
                        @csrf
                        <div class="form-group">
                            <label for="n_cuti">Nama Cuti</label>
                            <input type="text" class="form-control @error('n_cuti') is-invalid @enderror"
                                name="n_cuti" id="n_cuti" required autofocus value="{{ old('n_cuti') }}">
                            @error('n_cuti')
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
