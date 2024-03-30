@extends('dashboard.layouts.app')
@section('container')
<div class="container-fluid py-4 px-5">

    <div class="mt-4 row">
        <div class="col-12">
            <div class="card">
                <div class="pb-0 card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="">User Management </h5>
                            <p class="mb-0 text-sm">
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <button type="button" class="btn btn-dark btn-primary" data-bs-toggle="modal" data-bs-target="#adduser">
                                <i class="fas fa-user-plus me-2"></i> Add User
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover text-secondary text-center">
                        <thead>
                            <tr>
                                <th width="5%"
                                    class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                    No</th>
                                <th
                                    class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                    Photo</th>
                                <th
                                    class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                    Nama</th>
                                <th
                                    class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                    Email</th>
                                <th
                                    class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                    Role</th>

                                <th
                                    class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($user as $item)
                            <tr>
                                <td class="align-middle bg-transparent border-bottom">{{ $loop->iteration }}</td>
                                <td class="align-middle bg-transparent border-bottom">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img src="../assets/img/team-1.jpg" class="rounded-circle mr-2"
                                            alt="user1" style="height: 36px; width: 36px;">
                                    </div>
                                </td>
                                <td class="align-middle bg-transparent border-bottom">{{ $item->nama }}</td>
                                <td class="align-middle bg-transparent border-bottom">{{ $item->email }}</td>
                                <td class="text-center align-middle bg-transparent border-bottom">{{ $item->level }}</td>
                                <td class="text-center align-middle bg-transparent border-bottom">
                                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edituser-{{ $item->id }}"><i class="fa-solid fa-pencil"></i></button>

                                    <button  class="btn" type="button" data-bs-toggle="modal" data-bs-target="#modal-hapus-{{ $item->id }}"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">Data Kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($user as $item)
<div class="modal fade" id="modal-hapus-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">

        <div class="modal-body">
        Anda Yakin Untuk MengHapus?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
          <form action="/dashboard/data-user-management/{{ $item->id }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-dark" type="submit">
                Hapus
            </button>
        </form>
        </div>
      </div>
    </div>
  </div>
@endforeach

@include('dashboard.user.add')
@include('dashboard.user.edit')
@endsection