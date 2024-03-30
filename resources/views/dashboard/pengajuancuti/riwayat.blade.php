@extends('dashboard.layouts.app')
@section('container')
<div class="container-fluid py-4 px-5">

    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">List Pengajuan Cuti</h6>
                            <p class="text-sm"></p>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 py-0">
                    
                    <div class="table-responsive p-0">
                        <table class="table table-hover align-items-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7" width="5%">No
                                    </th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">Nama
                                    </th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                    Cuti</th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                        Keterangan</th>
                                    <th
                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                        Tanggal Mulai</th>
                                    <th
                                        class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                        Tanggal Selesai</th>
                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($list as $item)
                                <tr>
                                    <td class="text-center align-middle text-secondary text-sm font-weight-normal">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex align-items-center">
                                                <img src="../assets/img/team-2.jpg"
                                                    class="avatar avatar-sm rounded-circle me-2"
                                                    alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center ms-1">
                                                <h6 class="mb-0 text-sm font-weight-semibold">{{ $item->user->karyawan->n_depan . ' ' . $item->user->karyawan->n_belakang }}</h6>
                                                <p class="text-sm text-secondary mb-0">{{ $item->user->email }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td >
                                        <p class="text-secondary text-sm font-weight-normal">{{ $item->jeniscuti->n_cuti }}</p>
                                    </td>
                                    <td >
                                        <p class="text-secondary text-sm font-weight-normal">{{ $item->keterangan}}</p>
                                    </td>
                                    <td >
                                        <p class="text-center text-secondary text-sm font-weight-normal">{{ \Carbon\Carbon::parse($item->tgl_mulai)->format('d-M-Y')}}</p>
                                    </td>
                                    <td >
                                        <p class="text-center text-secondary text-sm font-weight-normal">{{ \Carbon\Carbon::parse($item->tgl_selesai)->format('d-M-Y')}}</p>
                                    </td>

                                    <td class="align-middle text-center ">
                                        @if($item->status == 'Accept')
                                            <span class="badge badge-lg border border-info text-info bg-info rounded-1">{{ $item->status }}</span>
                                            
                                        @elseif($item->status == 'Pending')
                                            <span class="badge badge-lg border border-warning text-warning bg-warning rounded-1">{{ $item->status }}</span>
                                        @elseif($item->status == 'Reject')
                                            <span class="badge badge-lg border border-danger text-danger bg-danger rounded-1">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-secondary text-xs font-weight-semibold opacity-7">Data Kosong</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
 
                </div>
            </div>
        </div>
    </div>



</div>

@endsection

