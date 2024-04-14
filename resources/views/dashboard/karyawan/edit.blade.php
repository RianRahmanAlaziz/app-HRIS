@foreach ($karyawan as $item)
    <!-- Modal -->
    <div class="modal fade" id="editpegawai-{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Jenis Cuti</h5>
                </div>
                <form action="/dashboard/data-pegawai/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <main class="form-signin w-100 m-auto">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="n_depan">Nama Depan</label>
                                        <input type="text"
                                            class="form-control @error('n_depan') is-invalid @enderror" name="n_depan"
                                            id="n_depan" required autofocus
                                            value="{{ old('n_depan', $item->n_depan) }}">
                                        @error('n_depan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="n_belakang">Nama Belakang</label>
                                        <input type="text"
                                            class="form-control @error('n_belakang') is-invalid @enderror"
                                            name="n_belakang" id="n_belakang" required autofocus
                                            value="{{ old('n_belakang', $item->n_belakang) }}">
                                        @error('n_belakang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jabatan_id">Jabatan</label>
                                <select class="form-select" name="jabatan_id">
                                    @foreach ($jabatans as $jabatan)
                                        @if (old('jabatan_id', $item->jabatan_id) == $jabatan->id)
                                            <option value="{{ $jabatan->id }}" selected>{{ $jabatan->n_jabatan }}
                                            </option>
                                        @else
                                            <option value="{{ $jabatan->id }}">{{ $jabatan->n_jabatan }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="no_hp">No Telepon</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">+62</span>
                                    <input type="tel" class="form-control @error('no_hp') is-invalid @enderror"
                                        name="no_hp" id="no_hp" required autofocus
                                        value="{{ old('no_hp', $item->no_hp) }}" maxlength="13"
                                        placeholder="812-3456-7891">
                                </div>
                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="" cols="5" rows="5"
                                    class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $item->alamat) }}</textarea>
                                @error('alamat')
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
