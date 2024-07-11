@extends('ui-karyawan.layouts.app')
@section('content')
    <style>
        .logout {
            position: absolute;
            color: white;
            font-size: 30px;
            text-decoration: none;
            right: 8px;

        }
    </style>
    <div class="section" id="user-section">

        <form action="/logout" method="post" class="logout">
            @csrf
            <button type="submit" class="border-0 " style="background-color:transparent">
                <ion-icon name="exit-outline" style="color: white"></ion-icon>
            </button>
        </form>
        <div id="user-detail">
            <div class="avatar">
                <img src="assets/img/pegawai/{{ auth()->user()->karyawan->gambar }}" alt="avatar" class="imaged w64"
                    style="height:70px">
            </div>
            <div id="user-info">
                <h2 id="user-name">{{ auth()->user()->karyawan->n_lengkap }}</h2>
                <span id="user-role">{{ auth()->user()->karyawan->jabatan->n_jabatan }}</span>
            </div>
        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/dashboard/user-profil" class="green" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/dashboard/pengajuan-cuti" class="danger" style="font-size: 40px;">

                                <ion-icon name="document-text"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Cuti</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="warning" style="font-size: 40px;">
                                <ion-icon name="calendar-number"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/dashboard/pesan" class="success" style="font-size: 40px;">
                                @if (auth()->check())
                                    @if (auth()->user()->unreadNotifications->count() > 0)
                                        <ion-icon name="mail-unread-outline"></ion-icon>
                                    @else
                                        <ion-icon name="mail-outline"></ion-icon>
                                    @endif
                                @endif
                            </a>
                        </div>
                        <div class="menu-name">
                            Pesan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col-6">
                    <div class="card gradasigreen">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    <ion-icon name="time"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Masuk</h4>
                                    <span>{{ $absensihariini != null ? $absensihariini->entry_time : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    <ion-icon name="time"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span>{{ $absensihariini != null && $absensihariini->exit_time != null ? $absensihariini->exit_time : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="rekapabsensi">
            <h3>Rekap Absensi Bulan {{ $namabulan[$bulanIni] }} Tahun {{ $tahunIni }}</h3>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding : 12px 12px !important">
                            <span class="badge bg-danger"
                                style="position:absolute; top:3px; right:5px; font-size:0.6rem; z-index:999">{{ $rekapabsensi->jmlhadir }}</span>
                            <ion-icon name="accessibility-outline" style="font-size: 1.6rem"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Hadir</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding : 12px 12px !important">
                            <span class="badge bg-danger"
                                style="position:absolute; top:3px; right:5px; font-size:0.6rem; z-index:999">{{ $rekap->jmlizin ?? 0 }}</span>
                            <ion-icon name="document-outline" style="font-size: 1.6rem" class="text-warning"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Izin</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding : 12px 12px !important">
                            <span class="badge bg-danger"
                                style="position:absolute; top:3px; right:5px; font-size:0.6rem; z-index:999">{{ $rekap->jmlsakit ?? 0 }}</span>
                            <ion-icon name="medkit-outline" style="font-size: 1.6rem" class="text-warning"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Sakit</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding : 12px 12px !important">
                            <span class="badge bg-danger"
                                style="position:absolute; top:3px; right:5px; font-size:0.6rem; z-index:999">{{ $rekapabsensi->jmlterlambat ?? 0 }}</span>
                            <ion-icon name="time-outline" style="font-size: 1.6rem" class="text-danger"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Telat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Bulan Ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Leaderboard
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <ul class="listview image-listview">
                        @forelse ($historybulanini as $item)
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-dark">
                                        <ion-icon name="finger-print-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>{{ $item->created_at->format('d-m-Y') }}</div>
                                        <span class="badge badge-success">{{ $item->entry_time }}</span>
                                        <span
                                            class="badge badge-danger">{{ $absensihariini != null && $item->exit_time != null ? $item->exit_time : 'Belum Absen Keluar' }}</span>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="finger-print-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>Belum Ada Absensi</div>
                                    </div>
                                </div>
                            </li>
                        @endforelse

                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <ul class="listview image-listview">
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>Edward Lindgren</div>
                                    <span class="text-muted">Designer</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>Emelda Scandroot</div>
                                    <span class="badge badge-primary">3</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>Henry Bove</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>Henry Bove</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>Henry Bove</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
