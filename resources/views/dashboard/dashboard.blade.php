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
        <div class="col-xl-3 col-sm-6 mb-xl-0">
            <div class="card border shadow-xs mb-4">
                <div class="card-body text-start p-3 w-100">
                    <div
                        class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                                    viewBox="0 0 24 24" fill="currentColor">
                            <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                        </svg>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100">
                                <p class="text-sm text-secondary mb-1">Pegawai</p>
                                <h4 class="mb-2 font-weight-bold">{{ $pegawai }}</h4>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0">
            <div class="card border shadow-xs mb-4">
                <div class="card-body text-start p-3 w-100">
                    <div
                        class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" fill="currentColor" viewBox="0 0 512 512">
                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                        
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100">
                                <p class="text-sm text-secondary mb-1">Saldo Cuti Tahunan</p>
                                @if(isset($saldo))
                                    <h4 class="mb-2 font-weight-bold">{{ $saldo }}</h4>
                                @else
                                    <h4 class="mb-2 font-weight-bold">0</h4>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0">
            <div class="card border shadow-xs mb-4">
                <div class="card-body text-start p-3 w-100">
                    <div
                        class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 6a3 3 0 013-3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm4.5 7.5a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0v-2.25a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0v4.5a.75.75 0 001.5 0V12zm2.25-3a.75.75 0 01.75.75v6.75a.75.75 0 01-1.5 0V9.75A.75.75 0 0113.5 9zm3.75-1.5a.75.75 0 00-1.5 0v9a.75.75 0 001.5 0v-9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100">
                                <p class="text-sm text-secondary mb-1">Avg. Transaction</p>
                                <h4 class="mb-2 font-weight-bold">$450.53</h4>
                                <div class="d-flex align-items-center">
                                    <span class="text-sm text-success font-weight-bolder">
                                        <i class="fa fa-chevron-up text-xs me-1"></i>22%
                                    </span>
                                    <span class="text-sm ms-1">from $369.30</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card border shadow-xs mb-4">
                <div class="card-body text-start p-3 w-100">
                    <div
                        class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.122-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="row ">
                        <div class="col-12">
                            <div class="w-100">
                                <p class="text-sm text-secondary mb-1">Coupon Sales</p>
                                <h4 class="mb-2 font-weight-bold">$23,364.55</h4>
                                <div class="d-flex align-items-center">
                                    <span class="text-sm text-success font-weight-bolder">
                                        <i class="fa fa-chevron-up text-xs me-1"></i>18%
                                    </span>
                                    <span class="text-sm ms-1">from $19,800.40</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-6">
            <div class="card shadow-xs border">
                
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
            @foreach ($list as $item)
            {
                title: '{{ $item->jeniscuti->n_cuti }}',
                start: '{{ \Carbon\Carbon::parse($item->tgl_mulai)->format('Y-m-d')}}',
                end:   '{{ \Carbon\Carbon::parse($item->tgl_selesai)->format('Y-m-d')}}' + 'T24:00:00',
                color: '{{ $item->status == "Accept" ? "#0d6efd" : "#ffc107" }}',
                allDay: true,
                
            },
            @endforeach
            
        ],
        dayCellDidMount: function(info) {
                var today = new Date();
                var cellDate = info.date.getDate();
                var cellMonth = info.date.getMonth();
                var cellYear = info.date.getFullYear();

                if (cellDate === today.getDate() && cellMonth === today.getMonth() && cellYear === today.getFullYear()) {
                    var cell = info.el;
                    cell.style.backgroundColor = 'rgba(0, 0, 0, 0.5)'; // Ubah warna latar belakang menjadi kuning untuk hari ini
                }
            },
    
    });
      calendar.render();
      
    });

 </script>


@endsection


