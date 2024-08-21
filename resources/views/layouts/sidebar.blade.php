<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="#" style="text-align: center">
            <img alt="Logo" src="{{ asset('assets/media/logo.png') }}" class="h-60px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('assets/media/logo-side.png') }}" class="h-35px app-sidebar-logo-minimize" />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-outline ki-black-left-line fs-3 rotate-180"></i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <!--begin::Scroll wrapper-->
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-element-11 fs-2"></i>
                            </span>
                            <span class="menu-title">Dashboards</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Pages</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    @if (auth()->user()->role == 'Admin')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('admin/akun-admin*') ? 'active' : '' }}" href="{{ route('akun-admin.index') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-user fs-2"></i>
                            </span>
                            <span class="menu-title">Akun Admin</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('admin/akun-mentor*') ? 'active' : '' }}" href="{{ route('akun-mentor.index') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-profile-user fs-2"></i>
                            </span>
                            <span class="menu-title">Akun Mentor</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('admin/data-mahasiswa*') ? 'active' : '' }}" href="{{ route('data-mahasiswa.index') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-profile-circle fs-2"></i>
                            </span>
                            <span class="menu-title">Akun Mahasiswa</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('admin/jadwal*') ? 'active' : '' }}" href="{{ route('jadwal.index') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-calendar fs-2"></i>
                            </span>
                            <span class="menu-title">Jadwal</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('admin/angkatan*') ? 'active' : '' }}" href="{{ route('angkatan.index') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-text-number fs-2"></i>
                            </span>
                            <span class="menu-title">Angkatan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('admin/kelompok-mentor*') ? 'active' : '' }}" href="{{ route('kelompok-mentor.index') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-people fs-2"></i>
                            </span>
                            <span class="menu-title">Mentor Kelompok</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('mentoring') ? 'active' : '' }}" href="{{ route('mentoring.index') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-notepad fs-2"></i>
                            </span>
                            <span class="menu-title">Laporan Resolusi</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('absensi') ? 'active' : '' }}" href="{{ route('absensi.index') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-file fs-2"></i>
                            </span>
                            <span class="menu-title">Laporan Kehadiran</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    @endif
                    @if (auth()->user()->role == 'Mentor')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('profil') ? 'active' : '' }}" href="{{ route('profil.edit') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-user fs-2"></i>
                            </span>
                            <span class="menu-title">Profil</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    {{-- <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('mentor/lihat-kelompok', 'mentor/lihat-mahasiswa*') ? 'active' : '' }}" href="{{ route('lihat-kelompok') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-people fs-2"></i>
                            </span>
                            <span class="menu-title">Lihat Kelompok</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item--> --}}
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('mentor/lihat-jadwal') ? 'active' : '' }}" href="{{ route('lihat-jadwal') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-calendar fs-2"></i>
                            </span>
                            <span class="menu-title">Jadwal</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('mentoring') ? 'active' : '' }}" href="{{ route('mentoring.index') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-notepad-edit fs-2"></i>
                            </span>
                            <span class="menu-title">Resolusi Mahasiswa</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('absensi') ? 'active' : '' }}" href="{{ route('absensi.index') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-file fs-2"></i>
                            </span>
                            <span class="menu-title">Absensi Mahasiswa</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    @endif
                    @if (auth()->user()->role == 'Mahasiswa')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('profil') ? 'active' : '' }}" href="{{ route('profil.edit') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-user fs-2"></i>
                            </span>
                            <span class="menu-title">Profil</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('mentoring') ? 'active' : '' }}" href="{{ route('mentoring.index') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-notepad fs-2"></i>
                            </span>
                            <span class="menu-title">Resolusi</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->is('absensi') ? 'active' : '' }}" href="{{ route('absensi.index') }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-file fs-2"></i>
                            </span>
                            <span class="menu-title">Absensi</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    @endif
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Scroll wrapper-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>