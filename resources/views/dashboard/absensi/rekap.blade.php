@extends('dashboard.layouts.app')
@section('container')
    <div class="container-fluid py-4 px-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
                <div class="card shadow-lg border">
                    <div class="card-header text-bg-dark border-bottom pb-0">
                        <h6 class="font-weight-semibold text-white text-lg mb-0">Laporan Absensi </h6>
                        <p class="text-sm"></p>
                    </div>
                    <div class="card-body py-3">
                        <form action="/dashboard/admin/laporan/rekap-absensi" method="post" target="_blank">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="bulan">Bulan</label>
                                        <select name="bulan" id="bulan" class="form-select">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}"
                                                    {{ (old('bulan') ?? request('bulan', date('m'))) == $i ? 'selected' : '' }}>
                                                    {{ $namabulan[$i] }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tahun">Tahun</label>
                                        <select name="tahun" id="tahun" class="form-select">
                                            @php
                                                $tahunmulai = 2022;
                                                $tahunsekarang = date('Y');
                                            @endphp
                                            @for ($tahun = $tahunmulai; $tahun <= $tahunsekarang; $tahun++)
                                                <option value="{{ $tahun }}"
                                                    {{ date('Y') == $tahun ? 'selected' : '' }}>
                                                    {{ $tahun }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" name="cetak" id="cetak" class="btn btn-dark w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px"
                                            viewBox="0 0 512 512">
                                            <path fill="#ffffff"
                                                d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                                        </svg>
                                        Cetak
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
