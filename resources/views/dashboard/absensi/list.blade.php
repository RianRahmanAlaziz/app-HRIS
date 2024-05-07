@extends('dashboard.layouts.app')
@section('container')
    <div class="container-fluid py-4 px-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
                <div class="card shadow-lg border ">
                    <div class="card-header text-bg-dark border-bottom pb-0">
                        <h6 class="font-weight-semibold text-white text-lg mb-0">Laporan Absensi </h6>
                        <p class="text-sm"></p>
                    </div>
                    <div class="card-body py-3">
                        <form action="/dashboard/absensi/laporan-absensi" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="bulan">Bulan</label>
                                        <select name="bulan" id="bulan" class="form-select">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ date('m') == $i ? 'selected' : '' }}>
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
                            <div class="form-group">
                                <select name="karyawan_id" id="karyawan_id"
                                    class="form-select @error('karyawan_id') is-invalid @enderror" required>
                                    <option disabled selected class="text-center">Pilih Karyawan</option>
                                    @foreach ($pegawai as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('karyawan_id') == $item->id || request()->input('karyawan_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->n_depan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('karyawan_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-dark w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15px" height="15px"
                                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path fill="#ffffff"
                                                d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                                        </svg>
                                        Cetak
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-dark w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="15px"
                                            height="15px"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path fill="#ffffff"
                                                d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                                        </svg>
                                        Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if ($filter && $absensi)
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border  shadow-lg mb-4">
                        <div class="card-header text-bg-dark border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-white text-lg mb-0">List Absensi
                                    </h6>
                                    <p class="text-sm"></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table table-hover align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7"
                                                width="5%">No
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Tanggal
                                            </th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Status</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Waktu Absensi</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Waktu Selesai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($absensi as $item)
                                            <tr>
                                                <td
                                                    class="text-center align-middle text-secondary text-sm font-weight-normal">
                                                    {{ $loop->iteration }}</td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-sm font-weight-normal">{{ $item->created_at->format('d-m-Y') }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="badge badge-sm border border-success text-success bg-success">Hadir</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-sm font-weight-normal">{{ $item->created_at->format('H:i:s') }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-sm font-weight-normal">{{ $item->updated_at->format('H:i:s') }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5"
                                                    class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                    Data Kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top  text-bg-dark py-3 px-3 d-flex align-items-center">
                                <button class="btn btn-sm btn-white d-sm-block d-none mb-0">Previous</button>
                                <nav aria-label="..." class="ms-auto">
                                    <ul class="pagination pagination-light mb-0">
                                        <li class="page-item " aria-current="page">
                                            <span class="page-link font-weight-bold">1</span>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link border-0 font-weight-bold" href="javascript:;">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link border-0 font-weight-bold d-sm-inline-flex d-none"
                                                href="javascript:;">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link border-0 font-weight-bold" href="javascript:;">...</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link border-0 font-weight-bold d-sm-inline-flex d-none"
                                                href="javascript:;">8</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link border-0 font-weight-bold" href="javascript:;">9</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link border-0 font-weight-bold" href="javascript:;">10</a>
                                        </li>
                                    </ul>
                                </nav>
                                <button class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
