@extends('ui-karyawan.layouts.app')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-dark text-light">
        <div class="left">
            <a href="/dashboard" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Histori Absensi</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select name="bulan" id="bulan" class="form-control">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ date('m') == $i ? 'selected' : '' }}>
                                    {{ $namabulan[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select name="tahun" id="tahun" class="form-control">
                            @php
                                $tahunmulai = 2022;
                                $tahunsekarang = date('Y');
                            @endphp
                            @for ($tahun = $tahunmulai; $tahun <= $tahunsekarang; $tahun++)
                                <option value="{{ $tahun }}" {{ date('Y') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark btn-block">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="15px"
                                height="15px"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#ffffff"
                                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                            </svg>
                            Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
