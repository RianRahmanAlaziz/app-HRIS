@extends('ui-karyawan.layouts.app')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-dark text-light">
        <div class="left">
            <a href="/dashboard" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Data Pengajuan Cuti/Izin</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top: 4rem">
        <div class="col">
            <ul class="listview image-listview">
                @forelse ($list as $item)
                    <li>
                        <div class="item">
                            <div class="in">
                                <div>
                                    <b>{{ $item->created_at->format('d-m-Y') }} ({{ $item->k_cuti }})</b><br>
                                    <small class="text-muted">{{ $item->catatan }}</small>
                                </div>
                                @if ($item->status == 'Accept')
                                    <span class="badge badge-success">{{ $item->status }}</span>
                                @elseif($item->status == 'Pending')
                                    <span class="badge badge-warning">{{ $item->status }}</span>
                                @elseif($item->status == 'Reject')
                                    <span class="badge badge-danger">{{ $item->status }}</span>
                                @endif

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
                                <div>Belum Ada Pengajuan</div>
                            </div>
                        </div>
                    </li>
                @endforelse

            </ul>
        </div>
    </div>
    <div class="fab-button bottom-right" style="margin-bottom: 70px">
        <a href="/dashboard/pengajuan-cuti/create" class="fab bg-dark"><ion-icon name="add-outline"></ion-icon></a>
    </div>
@endsection
