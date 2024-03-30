@extends('dashboard.layouts.app')
@section('container')
<div class="container-fluid py-4 px-5">
    <div class="d-flex justify-content-center">
        <div class="col-10">
            <div class="card border shadow-xs mb-4">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">Pengajuan Cuti</h6>
                            <p class="text-sm"></p>
                        </div>
                        <div class="ms-auto d-flex">
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                    <form action="/dashboard/pengajuan-cuti" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="k_cuti">Jenis Cuti</label>
                                <select class="form-select" name="k_cuti" id="k_cuti">
                                        <option value="Cuti Tahunan" >Cuti Tahunan</option>
                                        <option value="Cuti Lain-lain" >Cuti Lain-lain</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jeniscuti_id">Keterangan Cuti</label>
                                <select class="form-select" name="jeniscuti_id" id="jeniscuti_id">
                                        @foreach ($jcuti as $item)
                                        @if (old('jeniscuti_id') == $item->id)
                                        <option value="{{ $item->id }}" selected>Cuti {{ $item->n_cuti }}</option>
                                    @else
                                        <option value="{{ $item->id }}">Cuti {{ $item->n_cuti }}</option>
                                    @endif
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_mulai">Tanggal Mulai Cuti</label>
                                    <input type="date" class="form-control" name="tgl_mulai" id="tgl_mulai" value="{{ old('tgl_mulai') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_selesai">Tanggal Akhir Cuti</label>
                                    <input type="date" class="form-control" name="tgl_selesai" id="tgl_selesai" value="{{ old('tgl_selesai') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="catatan">Alasan Cuti</label>
                                <textarea name="catatan" id="catatan" cols="5" rows="5" class="form-control @error('catatan') is-invalid @enderror"></textarea>
                                @error('catatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="surat">Surat Cuti</label>
                                    <input type="file" class="form-control  @error('surat') is-invalid @enderror" name="surat" id="surat">
                                    @error('surat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        <div class="d-flex justify-content-end mt-5">
                            <button type="submit" class="btn btn-dark">Ajukan Cuti</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection

