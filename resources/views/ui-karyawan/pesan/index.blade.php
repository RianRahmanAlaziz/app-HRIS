@extends('ui-karyawan.layouts.app')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-dark text-light">
        <div class="left">
            <a href="/dashboard" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Pesan</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top: 4rem">
        <div class="col">
            <ul class="listview image-listview">
                @forelse (auth()->user()->unreadNotifications as $notification)
                    <li>
                        <div class="item" style="margin-bottom: 5px">
                            <div class="in">
                                <div>
                                    <b> {{ ucwords($notification->data['title']) }} Anda Di
                                        {{ ucwords($notification->data['status']) }} </b><br>
                                    <small class="text-muted">{{ ucwords($notification->data['messages']) }}</small>
                                </div>
                                <span class="badge">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </li>
                @empty
                    <li>
                        <div class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="mail-open-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Tidak Ada Pesan</div>
                            </div>
                        </div>
                    </li>
                @endforelse

            </ul>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('beforeunload', function(e) {
            navigator.sendBeacon("{{ route('notifications.markAsRead') }}", new URLSearchParams({
                _token: "{{ csrf_token() }}"
            }));
        });
    });
</script>
