<div class="appBottomMenu">
    <a href="/dashboard" class="item {{ Request::is('dashboard') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="#" class="item">
        <div class="col">
            <ion-icon name="calendar-outline" role="img" class="md hydrated" aria-label="calendar outline"></ion-icon>
            <strong>Calendar</strong>
        </div>
    </a>
    <a href="/dashboard/absensi" class="item {{ Request::is('dashboard/absensi') ? 'active' : '' }}">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="finger-print-outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="#" class="item">
        <div class="col">
            <ion-icon name="document-text-outline" role="img" class="md hydrated"
                aria-label="document text outline"></ion-icon>
            <strong>Docs</strong>
        </div>
    </a>
    <a href="/logout" class="item">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <form action="/logout" method="post">
                @csrf
                <button class="btn btn-dark" type="submit">
                    Logout
                </button>
            </form>
            {{-- <strong>logout</strong> --}}
        </div>
    </a>
</div>
