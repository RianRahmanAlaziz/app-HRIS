<div class="appBottomMenu">
    <a href="/dashboard" class="item {{ Request::is('dashboard') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="/dashboard/histori-absensi" class="item {{ Request::is('dashboard/histori-absensi') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="clipboard-outline" role="img" class="md hydrated"
                aria-label="calendar outline"></ion-icon>
            <strong>Histori</strong>
        </div>
    </a>
    <a href="/dashboard/absensi" class="item {{ Request::is('dashboard/absensi') ? 'active' : '' }}">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="finger-print-outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="/dashboard/pengajuan-cuti" class="item {{ Request::is('dashboard/pengajuan-cuti') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="calendar-outline" role="img" class="md hydrated"
                aria-label="document text outline"></ion-icon>
            <strong>Izin</strong>
        </div>
    </a>
    <a href="/dashboard/user-profil" class="item">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profil</strong>
        </div>
    </a>
</div>
