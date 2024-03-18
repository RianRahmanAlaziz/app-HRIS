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



</div>

@endsection


