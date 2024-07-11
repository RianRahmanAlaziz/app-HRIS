<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start " id="sidenav-main"
    data-color="white">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0" href="/dashboard">
            <span class="font-weight-bold text-lg">Dashboard</span>
        </a>
    </div>
    <div class="collapse navbar-collapse px-4  w-auto accordion" id="sidenav-collapse-main">
        <ul class="navbar-nav accordion" id="accordionSidebar">
            {{-- dashboard --}}
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('dashboard/admin') ? 'active' : '' }}" href="/dashboard/admin">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>dashboard</title>
                            <g id="dashboard" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="template" transform="translate(12.000000, 12.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <path class="color-foreground"
                                        d="M0,1.71428571 C0,0.76752 0.76752,0 1.71428571,0 L22.2857143,0 C23.2325143,0 24,0.76752 24,1.71428571 L24,5.14285714 C24,6.08962286 23.2325143,6.85714286 22.2857143,6.85714286 L1.71428571,6.85714286 C0.76752,6.85714286 0,6.08962286 0,5.14285714 L0,1.71428571 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M0,12 C0,11.0532171 0.76752,10.2857143 1.71428571,10.2857143 L12,10.2857143 C12.9468,10.2857143 13.7142857,11.0532171 13.7142857,12 L13.7142857,22.2857143 C13.7142857,23.2325143 12.9468,24 12,24 L1.71428571,24 C0.76752,24 0,23.2325143 0,22.2857143 L0,12 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M18.8571429,10.2857143 C17.9103429,10.2857143 17.1428571,11.0532171 17.1428571,12 L17.1428571,22.2857143 C17.1428571,23.2325143 17.9103429,24 18.8571429,24 L22.2857143,24 C23.2325143,24 24,23.2325143 24,22.2857143 L24,12 C24,11.0532171 23.2325143,10.2857143 22.2857143,10.2857143 L18.8571429,10.2857143 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            {{-- data master --}}

            <li class="nav-item">
                <div class="nav-link">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>rtl</title>
                            <g id="rtl" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="menu-alt-3" transform="translate(12.000000, 14.000000)" fill="#FFFFFF">
                                    <path class="color-foreground"
                                        d="M0,1.71428571 C0,0.76752 0.76752,0 1.71428571,0 L22.2857143,0 C23.2325143,0 24,0.76752 24,1.71428571 C24,2.66105143 23.2325143,3.42857143 22.2857143,3.42857143 L1.71428571,3.42857143 C0.76752,3.42857143 0,2.66105143 0,1.71428571 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M0,10.2857143 C0,9.33894857 0.76752,8.57142857 1.71428571,8.57142857 L22.2857143,8.57142857 C23.2325143,8.57142857 24,9.33894857 24,10.2857143 C24,11.2325143 23.2325143,12 22.2857143,12 L1.71428571,12 C0.76752,12 0,11.2325143 0,10.2857143 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M10.2857143,18.8571429 C10.2857143,17.9103429 11.0532343,17.1428571 12,17.1428571 L22.2857143,17.1428571 C23.2325143,17.1428571 24,17.9103429 24,18.8571429 C24,19.8039429 23.2325143,20.5714286 22.2857143,20.5714286 L12,20.5714286 C11.0532343,20.5714286 10.2857143,19.8039429 10.2857143,18.8571429 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Data Master</span>
                </div>
            </li>
            @hasrole('Admin')
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ Request::is('dashboard/admin/data-user-management') ? 'active' : '' }}"
                        href="/dashboard/admin/data-user-management">
                        <span class="nav-link-text ms-1">Data User</span>
                    </a>
                </li>
            @endhasrole
            @hasrole('Admin|HRD')
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ Request::is('dashboard/admin/data-pegawai') ? 'active' : '' }}"
                        href="/dashboard/admin/data-pegawai">
                        <span class="nav-link-text ms-1">Data Pegawai</span>
                    </a>
                </li>
            @endhasrole
            @hasrole('Admin')
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ Request::is('dashboard/admin/data-jabatan') ? 'active' : '' }}"
                        href="/dashboard/admin/data-jabatan">
                        <span class="nav-link-text ms-1">Data Jabatan</span>
                    </a>
                </li>
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ Request::is('dashboard/admin/data-jenis-cuti') ? 'active' : '' }}"
                        href="/dashboard/admin/data-jenis-cuti">
                        <span class="nav-link-text ms-1">Data Jenis Cuti</span>
                    </a>
                </li>
            @endhasrole

            @hasanyrole('HRD')
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('dashboard/admin/list-pengajuan-cuti') ? 'active' : '' }}"
                        href="/dashboard/admin/list-pengajuan-cuti">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 576 512">
                                <!-- Bagian pertama -->
                                <path class="color-background" fill="#000000"
                                    d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V299.6l-94.7 94.7c-8.2 8.2-14 18.5-16.8 29.7l-15 60.1c-2.3 9.4-1.8 19 1.4 27.8H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128z" />
                                <!-- Bagian kedua -->
                                <path class="color-foreground" fill="#000000"
                                    d="M549.8 235.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-29.4 29.4-71-71 29.4-29.4c15.6-15.6 40.9-15.6 56.6 0zM311.9 417L441.1 287.8l71 71L382.9 487.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z" />
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Daftar Pengajuan Cuti</span>
                    </a>
                </li>
                {{-- Laporan --}}
                <li class="nav-item">
                    <div class="nav-link">
                        <div
                            class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>rtl</title>
                                <g id="rtl" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="menu-alt-3" transform="translate(12.000000, 14.000000)" fill="#FFFFFF">
                                        <path class="color-foreground"
                                            d="M0,1.71428571 C0,0.76752 0.76752,0 1.71428571,0 L22.2857143,0 C23.2325143,0 24,0.76752 24,1.71428571 C24,2.66105143 23.2325143,3.42857143 22.2857143,3.42857143 L1.71428571,3.42857143 C0.76752,3.42857143 0,2.66105143 0,1.71428571 Z"
                                            id="Path"></path>
                                        <path class="color-background"
                                            d="M0,10.2857143 C0,9.33894857 0.76752,8.57142857 1.71428571,8.57142857 L22.2857143,8.57142857 C23.2325143,8.57142857 24,9.33894857 24,10.2857143 C24,11.2325143 23.2325143,12 22.2857143,12 L1.71428571,12 C0.76752,12 0,11.2325143 0,10.2857143 Z"
                                            id="Path"></path>
                                        <path class="color-background"
                                            d="M10.2857143,18.8571429 C10.2857143,17.9103429 11.0532343,17.1428571 12,17.1428571 L22.2857143,17.1428571 C23.2325143,17.1428571 24,17.9103429 24,18.8571429 C24,19.8039429 23.2325143,20.5714286 22.2857143,20.5714286 L12,20.5714286 C11.0532343,20.5714286 10.2857143,19.8039429 10.2857143,18.8571429 Z"
                                            id="Path"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Laporan</span>
                    </div>
                </li>
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ Request::is('dashboard/admin/laporan/laporan-absensi') ? 'active' : '' }}"
                        href="/dashboard/admin/laporan/laporan-absensi">
                        <span class="nav-link-text ms-1">Absensi</span>
                    </a>
                </li>
                <li class="nav-item border-start my-0 pt-2">
                    <a class="nav-link position-relative ms-0 ps-2 py-2 {{ Request::is('dashboard/admin/laporan/rekap-absensi') ? 'active' : '' }}"
                        href="/dashboard/admin/laporan/rekap-absensi">
                        <span class="nav-link-text ms-1">Rekap Absensi</span>
                    </a>
                </li>
            @endhasanyrole

        </ul>
    </div>
</aside>
