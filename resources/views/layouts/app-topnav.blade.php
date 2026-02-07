<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" wire:navigate class="nav-link waves-effect">
                            <i class="dripicons-home"></i>
                            <span key="t-dashboards">Dashboards</span>
                        </a>
                    </li>
                    @role('user')
                        <li class="nav-item">
                            <a href="{{ url('agenda') }}" wire:navigate class="nav-link waves-effect">
                                <i class="bx bx-calendar"></i>
                                <span key="t-agenda">Agenda</span>
                            </a>
                        </li>
                    @endrole
                    @role('admin')
                        <li class="nav-item">
                            <a href="{{ url('bidang') }}" wire:navigate class="nav-link waves-effect">
                                <i class="mdi mdi-grid-large"></i>
                                <span key="t-bidang">Bidang</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('users') }}" wire:navigate class="nav-link waves-effect">
                                <i class="dripicons-user-group"></i>
                                <span key="t-users">Users</span>
                            </a>
                        </li>
                    @endrole
                    {{-- <li class="nav-item">
                        <a href="{{ url('events') }}"
                            class="nav-link waves-effect {{ request()->routeIs('event*') ? 'active' : '' }}">
                            <i class="bx bx-calendar"></i>
                            <span key="t-events">Events</span>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </nav>
    </div>
</div>
