@extends('dashboard.layouts.app')
@section('container')
    <div class="container-fluid py-4 px-5">
        <div class="d-flex justify-content-center">
            <div class="col-10">
                <div class="card border shadow-lg mb-4">
                    <div class="card-header text-bg-dark border-bottom pb-0">
                        <div class="d-sm-flex align-items-center">
                            <div>
                                <h6 class="font-weight-semibold text-white text-lg mb-0">Absensi Hari Ini {{ $date }}
                                    <span id="clock"></span>
                                </h6>
                                <p class="text-sm"></p>
                            </div>
                            <div class="ms-auto d-flex">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (!$absensi)
                            <form role="form" action="/dashboard/absensi/{{ $pegawai->id }}" method="POST"
                                enctype="multipart/form-data">
                            @else
                                <form role="form" action="/dashboard/absensi/{{ $absensi->id }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                        @endif
                        @csrf
                        @if (date('H') >= 17)
                            <h6 class="font-weight-semibold text-center text-lg mb-0"> Absensi Ditutup</h6>
                        @else
                            @if (!$absensi)
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="entry_time">Waktu Absensi</label>
                                            <input type="text" class="form-control text-center" name="entry_time"
                                                id="entry_time" placeholder="--:--:--" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entry_location">Lokasi Absensi</label>
                                            <input type="text" class="form-control text-center" id="entry_loc"
                                                name="entry_loc" placeholder="Locaton Loading..." disabled>
                                            <input type="text" name="entry_location" id="entry_location" hidden>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="entry_ip">IP Address</label>
                                            <input type="text" class="form-control text-center " name="entry_ip"
                                                id="entry_ip" placeholder="X.X.X.X" disabled>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="entry_time">Waktu Absensi</label>
                                            <input type="text" class="form-control text-center bg-dark text-white"
                                                name="entry_time" id="entry_time" placeholder="--:--:--"
                                                value="{{ $absensi->created_at->format('d-m-Y,  H:i:s') }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="entry_location">Lokasi Absensi</label>
                                            <input type="text" class="form-control text-center bg-dark text-white"
                                                value="{{ $absensi->entry_location }}" name="entry_location"
                                                id="entry_location" placeholder="..." disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="entry_ip">IP Address</label>
                                            <input type="text" value="{{ $absensi->entry_ip }}"
                                                class="form-control text-center bg-dark text-white" name="entry_ip"
                                                id="entry_ip" placeholder="X.X.X.X" disabled>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!$registered_absensi)
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exit_time">Waktu Selesai</label>
                                            <input type="text" class="form-control text-center" name="exit_time"
                                                id="exit_time" placeholder="--:--:--" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exit_location">Lokasi Selesai</label>
                                            <input type="text" class="form-control text-center" id="exit_loc"
                                                name="exit_loc"
                                                @if ($absensi) placeholder="Loading location..."
                                                
                                            @else
                                            placeholder="..." @endif
                                                disabled />
                                            <input type="text" name="exit_location" id="exit_location" hidden>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exit_ip">IP Address</label>
                                            <input type="text" class="form-control text-center" name="exit_ip"
                                                id="exit_ip" placeholder="X.X.X.X" disabled>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exit_time">Waktu Selesai</label>
                                            <input type="text" class="form-control text-center bg-dark text-white"
                                                name="exit_time"
                                                value="{{ $absensi->updated_at->format('d-m-Y,  H:i:s') }}" id="exit_time"
                                                placeholder="--:--:--" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exit_location">Lokasi Selesai</label>
                                            <input type="text" class="form-control text-center bg-dark text-white"
                                                name="exit_location" value="{{ $absensi->exit_location }}"
                                                id="exit_location" placeholder="..." disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exit_ip">IP Address</label>
                                            <input type="text" class="form-control text-center bg-dark text-white"
                                                name="exit_ip" value="{{ $absensi->exit_ip }}" id="exit_ip"
                                                placeholder="X.X.X.X" disabled>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!$registered_absensi)
                                @if (!$absensi)
                                    <div class="d-flex justify-content-start mt-5">
                                        <button type="submit" class="btn btn-dark"> Absen Masuk</button>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-end mt-5">
                                        <button type="submit" class="btn btn-dark"> Absen Keluar/Selesai</button>
                                    </div>
                                @endif
                            @endif
                        @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script src="/assets/js/clock.js"></script>
    <script>
        $(document).ready(function() {
            if ("geolocation" in navigator) {
                console.log("gl available");
                navigator.geolocation.getCurrentPosition(position => {
                    console.log(position.coords.latitude + "," + position.coords.longitude);
                    $.ajax({
                        type: "POST",
                        url: "/dashboard/absensi/get-location",
                        data: {
                            lat: position.coords.latitude,
                            lon: position.coords.longitude,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            console.log(!'{{ $registered_absensi }}');
                            $('#entry_loc').val(data);
                            $('#entry_location').val(data);
                            @if ($absensi)
                                $('#exit_loc').val(data);
                                $('#exit_location').val(data);
                            @endif
                        },
                        error: function() {
                            $('#address').val('Denied Permission to retrieve location');
                        }
                    });
                }, function() {
                    $('#address').val('Denied Permission to retrieve location');
                });
            } else {
                $('#address').html("Location not available");
            }
        });
    </script>
@endsection
