@extends('dashboard.layouts.app')
@section('container')
    <div class="container-fluid py-4 px-5">
        <div class="row">
            <div class="col-md-12">
                <div class="d-md-flex align-items-center mb-3 mx-2">
                    <div class="mb-md-0 mb-3">
                        <h3 class="font-weight-bold mb-0">Selamat Datang {{ auth()->user()->nama }}</h3>

                    </div>
                </div>
            </div>
        </div>
        <hr class="my-0">
        <div class="row mt-4">
            {{-- pegawai jumlah --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0">
                <div class="card border shadow-lg mb-4">
                    <div class="card-body text-start p-3 w-100">
                        <div
                            class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                            </svg>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="w-100">
                                    <p class="text-sm text-secondary mb-1">Jumlah Pegawai</p>
                                    <h4 class="mb-2 font-weight-bold">{{ $pegawai ?? 0 }}</h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- pegawai hadir --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0">
                <div class="card border shadow-lg mb-4">
                    <div class="card-body text-start p-3 w-100">
                        <div
                            class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                height="22" width="22" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7.864 4.243A7.5 7.5 0 0 1 19.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 0 0 4.5 10.5a7.464 7.464 0 0 1-1.15 3.993m1.989 3.559A11.209 11.209 0 0 0 8.25 10.5a3.75 3.75 0 1 1 7.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 0 1-3.6 9.75m6.633-4.596a18.666 18.666 0 0 1-2.485 5.33" />
                            </svg>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="w-100">
                                    <p class="text-sm text-secondary mb-1">Pegawai Hadir</p>
                                    <h4 class="mb-2 font-weight-bold">{{ $rekap->jmlhadir }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- pegawai terlambat --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0">
                <div class="card border shadow-lg mb-4">
                    <div class="card-body text-start p-3 w-100">
                        <div
                            class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                height="24" width="24" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="w-100">
                                    <p class="text-sm text-secondary mb-1">Pegawai Terlambat</p>
                                    <h4 class="mb-2 font-weight-bold">{{ $rekap->jmlterlambat ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- pegawai sakit --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0">
                <div class="card border shadow-lg mb-4">
                    <div class="card-body text-start p-3 w-100">
                        <div
                            class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                            </svg>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="w-100">
                                    <p class="text-sm text-secondary mb-1">Pegawai Sakit</p>
                                    <h4 class="mb-2 font-weight-bold">{{ $rekapizin->jmlsakit ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- pegawai izin --}}
            <div class="col-xl-3 col-sm-6 mb-xl-0">
                <div class="card border shadow-lg mb-4">
                    <div class="card-body text-start p-3 w-100">
                        <div
                            class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                            </svg>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="w-100">
                                    <p class="text-sm text-secondary mb-1">Pegawai Izin</p>
                                    <h4 class="mb-2 font-weight-bold">{{ $rekapizin->jmlizin ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="card shadow-lg border">

                    <div class="card-body">
                        <div class="align-self-center">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5',
                timeZone: 'local',
                locale: 'id',
                headerToolbar: {
                    end: 'prevYear,prev,today,next,nextYear'
                },
                buttonText: {
                    today: 'Hari Ini',
                },
                events: [


                ],
                dayCellDidMount: function(info) {
                    var today = new Date();
                    var cellDate = info.date.getDate();
                    var cellMonth = info.date.getMonth();
                    var cellYear = info.date.getFullYear();

                    if (cellDate === today.getDate() && cellMonth === today.getMonth() && cellYear ===
                        today.getFullYear()) {
                        var cell = info.el;
                        cell.style.backgroundColor =
                            'rgba(0, 0, 0, 0.5)'; // Ubah warna latar belakang menjadi kuning untuk hari ini
                    }
                },

            });
            calendar.render();

        });
    </script>
@endsection
