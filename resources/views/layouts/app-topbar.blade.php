<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ url('/') }}" wire:navigate class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/tangkab.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/bkpsdm-dark.png') }}" alt="" height="17">
                    </span>
                </a>

                <a href="{{ url('/') }}" wire:navigate class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/tangkab.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/bkpsdm-light.png') }}" alt="" height="19">
                    </span>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light"
                data-toggle="collapse" data-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ URL::asset('assets/images/users/avatar.png') }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ml-1" key="t-user">{{ Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('password') }}" wire:navigate><i
                            class="bx bx-lock font-size-16 align-middle mr-1"></i>
                        <span key="t-password">Ubah Password</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" wire:navigate><i
                            class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> <span
                            key="t-logout">Logout</span></a>
                </div>
            </div>
            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>
        </div>
    </div>
</header>
