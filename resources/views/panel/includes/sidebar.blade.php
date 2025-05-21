<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-column" style="color: #2358b3;"></i>
                    </div>
                    Dashboard
                </a>
                @if (Auth::user()->role == 'admin')
                    <a class="nav-link {{ Request::is('admin/session') ? 'active' : '' }}" href="/admin/session">
                        <div class="sb-nav-link-icon"><i class="fa-regular fa-rectangle-list"
                                style="color: #2358b3;"></i></div>
                        Session
                    </a>
                    <a class="nav-link {{ Request::is('admin/semester') ? 'active' : '' }}" href="/admin/semester">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-list" style="color: #2358b3;"></i></div>
                        Semester
                    </a>
                    <a class="nav-link {{ Request::is('admin/teachers') ? 'active' : '' }}" href="/admin/teachers">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users" style="color: #2358b3;"></i></i>
                        </div>
                        Teachers
                    </a>
                    <a class="nav-link {{ Request::is('admin/offer-list') ? 'active' : '' }}" href="/admin/offer-list">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-table-list" style="color: #2358b3;"></i>
                        </div>
                        Offer List
                    </a>
                    <a class="nav-link {{ Request::is('/admin/routines') ? 'active' : '' }}" href="/admin/routines">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-table-list" style="color: #2358b3;"></i>
                        </div>
                       Routine
                    </a>
                @endif
                @if (Auth::user()->role == 'teacher')
                    <a class="nav-link {{ Request::is('teacher/offers') ? 'active' : '' }}" href="/teacher/offers">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-table-list" style="color: #2358b3;"></i>
                        </div>
                        Offers
                    </a>
                @endif
                <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="/profile">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user" style="color: #2358b3;"></i></i></div>
                    Profile
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as: <br><b class="text-white">
                    @if (Auth::user()->role == 'admin')
                        <b>Website Admin</b>
                    @else
                        Teacher
                    @endif
                </b></div>
            <b class="text-white">{{ Auth::user()->name }}</b>
        </div>
    </nav>
</div>
