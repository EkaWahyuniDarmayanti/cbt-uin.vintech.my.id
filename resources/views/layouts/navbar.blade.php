<div class="app-navbar flex-shrink-0">
  <!--begin::User menu-->
  <div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
    <!--begin::Menu wrapper-->
    <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
      <img src="{{ auth()->user()->foto ? url(Storage::url(auth()->user()->foto)) : asset('assets/media/avatars/blank.png') }}" class="rounded-3" alt="user" />
    </div>
    <!--begin::User account menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
      <!--begin::Menu item-->
      <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
          <!--begin::Avatar-->
          <div class="symbol symbol-50px me-5">
            <img alt="Logo" src="{{ auth()->user()->foto ? url(Storage::url(auth()->user()->foto)) : asset('assets/media/avatars/blank.png') }}" />
          </div>
          <!--end::Avatar-->
          <!--begin::Username-->
          <div class="d-flex flex-column">
            <div class="fw-bold d-flex align-items-center fs-5">{{ auth()->user()->name }}</div>
            <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
          </div>
          <!--end::Username-->
        </div>
      </div>
      <!--end::Menu item-->
      <!--begin::Menu item-->
      <div class="menu-item px-5">
        <a href="{{ route('user.password.edit') }}" class="menu-link px-5">Ganti Password</a>
      </div>
      <!--end::Menu item-->
      <!--begin::Menu separator-->
      <div class="separator my-2"></div>
      <!--end::Menu separator-->
      <!--begin::Menu item-->
      <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
        <a href="#" class="menu-link px-5">
          <span class="menu-title position-relative">Mode
          <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
            <i class="ki-outline ki-night-day theme-light-show fs-2"></i>
            <i class="ki-outline ki-moon theme-dark-show fs-2"></i>
          </span></span>
        </a>
        <!--begin::Menu-->
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu">
          <!--begin::Menu item-->
          <div class="menu-item px-3 my-0">
            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
              <span class="menu-icon" data-kt-element="icon">
                <i class="ki-outline ki-night-day fs-2"></i>
              </span>
              <span class="menu-title">Light</span>
            </a>
          </div>
          <!--end::Menu item-->
          <!--begin::Menu item-->
          <div class="menu-item px-3 my-0">
            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
              <span class="menu-icon" data-kt-element="icon">
                <i class="ki-outline ki-moon fs-2"></i>
              </span>
              <span class="menu-title">Dark</span>
            </a>
          </div>
          <!--end::Menu item-->
        </div>
        <!--end::Menu-->
      </div>
      <!--end::Menu item-->
      <!--begin::Menu item-->
      <div class="menu-item px-5">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
                              this.closest('form').submit();" class="menu-link px-5">
              <span>Log Out</span>
          </a>
      </form>
        {{-- <a href="" class="menu-link px-5">Sign Out</a> --}}
      </div>
      <!--end::Menu item-->
    </div>
    <!--end::User account menu-->
    <!--end::Menu wrapper-->
  </div>
  <!--end::User menu-->
  <!--begin::Aside toggle-->
  <!--end::Header menu toggle-->
</div>