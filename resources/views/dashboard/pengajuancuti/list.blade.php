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

                        <div class="table-responsive p-0 ">
                            <table class="table table-hover  align-items-center mb-0">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7" width="1%">No
                                        </th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Nama
                                        </th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                            Cuti</th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Surat</th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Tanggal Mulai</th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Tanggal Selesai</th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($list as $item)
                                        <tr>
                                            <td class="text-center text-secondary text-sm font-weight-normal">
                                                {{ $loop->iteration }}</td>
                                            <td>
                                                <p class="text-secondary text-sm font-weight-normal">
                                                    {{ $item->user->karyawan->n_depan . ' ' . $item->user->karyawan->n_belakang }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-secondary text-sm font-weight-normal">
                                                    {{ $item->jeniscuti->n_cuti }}</p>
                                            </td>

                                            <td class="text-center align-middle bg-transparent border-bottom">
                                                <a href="/assets/file/pengajuan-cuti/{{ $item->surat }}"
                                                    class="btn btn-outline-dark"
                                                    download="Surat-Cuti-{{ $item->user->karyawan->n_depan }}">Unduh</a>
                                            </td>
                                            <td>
                                                <p class="text-center text-secondary text-sm font-weight-normal">
                                                    {{ \Carbon\Carbon::parse($item->tgl_mulai)->format('d-m-Y') }}</p>
                                            </td>
                                            <td>
                                                <p class="text-center text-secondary text-sm font-weight-normal">
                                                    {{ \Carbon\Carbon::parse($item->tgl_selesai)->format('d-M-Y') }}</p>
                                            </td>

                                            <td class="text-center align-middle bg-transparent border-bottom">
                                                <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal"
                                                    data-bs-target="#addjabatan">Reject</button>
                                                <form action="/dashboard/list-pengajuan-cuti/{{ $item->id }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    <input type="text" name="status" id="status" hidden
                                                        value="Accept">
                                                    <button type="submit" class="btn btn-outline-info">Accept</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8"
                                                class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                                Data Kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @foreach ($list as $item)
            <!-- Modal -->
            <div class="modal fade" id="addjabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="/dashboard/list-pengajuan-cuti/{{ $item->id }}" method="POST">
                            <div class="modal-body">
                                <main class="form-signin w-100 m-auto">
                                    @csrf
                                    <input type="text" name="status" id="status" hidden value="Reject">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" cols="5" rows="5" class="form-control"></textarea>
                                    </div>
                                </main>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </div>
    @endforeach
@endsection
