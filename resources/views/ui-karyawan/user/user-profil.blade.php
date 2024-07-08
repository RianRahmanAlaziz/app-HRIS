@extends('ui-karyawan.layouts.app')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-dark text-light">
        <div class="left">
            <a href="/dashboard" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Edit Profil</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <form action="/dashboard/user-profil/{{ $user->id }}/update" method="POST" enctype="multipart/form-data"
        style="margin-top: 4rem; padding-bottom: 100px;">
        @csrf
        <div class="col">
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="text" class="form-control" name="n_lengkap" id="n_lengkap"
                        value="{{ old('n_lengkap', $user->n_lengkap) }}" autocomplete="off">
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="text" class="form-control" id="email" name="email"
                        value="{{ old('email', $user->user->email) }}" autocomplete="off">
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="text" class="form-control" value="{{ old('no_hp', $user->no_hp) }}" name="no_hp"
                        id="no_hp" autocomplete="off">
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="password" class="form-control" name="password" id="password" autocomplete="off"
                        placeholder="Password">
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <input type="alamat" class="form-control" name="alamat" id="alamat"
                        value="{{ old('email', $user->alamat) }}" placeholder="Alamat . . ." autocomplete="off">
                </div>
            </div>

            <div class="custom-file-upload" id="fileUpload1">
                <input type="file" name="gambar" id="gambar" accept=".png, .jpg, .jpeg">
                <label for="gambar">
                    <span>
                        <strong>
                            <ion-icon name="cloud-upload-outline" role="img" class="md hydrated"
                                aria-label="cloud upload outline"></ion-icon>
                            <i>Tap to Upload</i>
                        </strong>
                    </span>
                </label>
            </div>
            <div class="form-group boxed" style="margin-bottom: 10px !important">
                <div class="input-wrapper">
                    <button type="submit" class="btn btn-dark btn-block">
                        <ion-icon name="refresh-outline"></ion-icon>
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="tab-pane">

    </div>
@endsection
