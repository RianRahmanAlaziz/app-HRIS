@extends('ui-karyawan.layouts.app')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-dark text-light">
        <div class="left">
            <a href="/dashboard/pengajuan-cuti" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Pengajuan Cuti/Izin</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <form action="/dashboard/pengajuan-cuti" style="margin-top: 70px; padding-bottom: 150px;" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="col">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="k_cuti">Jenis Pengajuan</label>
                        <select name="k_cuti" id="k_cuti" class="form-control">
                            <option value="Sakit">Sakit</option>
                            <option value="Izin">Izin</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="jeniscuti_id">Keterangan Cuti</label>
                        <select class="form-control" name="jeniscuti_id" id="jeniscuti_id">
                            @foreach ($jcuti as $item)
                                @if (old('jeniscuti_id') == $item->id)
                                    <option value="{{ $item->id }}" selected>Cuti {{ $item->n_cuti }}
                                    </option>
                                @else
                                    <option value="{{ $item->id }}">Cuti {{ $item->n_cuti }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tgl_mulai">Tanggal Mulai Cuti</label>
                        <input type="date" class="form-control" name="tgl_mulai" id="tgl_mulai"
                            value="{{ old('tgl_mulai') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tgl_selesai">Tanggal Akhir Cuti</label>
                        <input type="date" class="form-control" name="tgl_selesai" id="tgl_selesai"
                            value="{{ old('tgl_selesai') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="catatan">Alasan Cuti</label>
                        <textarea name="catatan" id="catatan" cols="5" rows="5"
                            class="form-control @error('catatan') is-invalid @enderror"></textarea>
                        @error('catatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="surat">Surat Cuti</label>
                        <input type="file" class="form-control  @error('surat') is-invalid @enderror" name="surat"
                            id="surat">
                        @error('surat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark btn-block">
                            Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
