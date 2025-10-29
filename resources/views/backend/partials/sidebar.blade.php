<!--APP-SIDEBAR-->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar" style="overflow: scroll">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('dashboard') }}">
                <img src="{{ asset($settings->logo ?? 'default/logo.png') }}" class="header-brand-img desktop-logo"
                    alt="logo">
                <img src="{{ asset($settings->logo ?? 'default/logo.png') }}" class="header-brand-img toggle-logo"
                    alt="logo">
                <img src="{{ asset($settings->logo ?? 'default/logo.png') }}" class="header-brand-img light-logo"
                    alt="logo">
                <img src="{{ asset($settings->logo ?? 'default/logo.png') }}" class="header-brand-img light-logo1"
                    alt="logo">
            </a>
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg>
            </div>

            <ul class="side-menu mt-2">
                <li>
                    <h3>Menu</h3>
                </li>

                {{-- Dashboard --}}
                <li class="slide">
                    <a class="side-menu__item {{ request()->routeIs('dashboard') ? 'has-link' : '' }}"
                        href="{{ route('dashboard') }}">
                        <i class="fa fa-dashboard"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                {{-- Employee Manage --}}
                <li class="slide">
                    <a class="side-menu__item {{ request()->routeIs('employee.list') ? 'has-link' : '' }}"
                        href="{{ route('employee.list') }}">
                        <i class="fa fa-user"></i>
                        <span class="side-menu__label">Employee Manage</span>
                    </a>
                </li>

                {{-- Team Manage --}}
                <li class="slide">
                    <a class="side-menu__item {{ request()->routeIs('team.list') ? 'has-link' : '' }}"
                        href="{{ route('team.list') }}">
                        <i class="fa fa-users"></i>
                        <span class="side-menu__label">Team Manage</span>
                    </a>
                </li>

                {{-- Work Manage --}}
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <i class="fa fa-lightbulb"></i>
                        <span class="side-menu__label">Work Manage</span>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('work.list') }}" class="slide-item">Work List</a></li>
                        <li><a href="{{ route('reschedule.work.list') }}" class="slide-item">Reschedule Request</a>
                        </li>
                    </ul>
                </li>

                {{-- Calendar --}}
                <li class="slide">
                    <a class="side-menu__item {{ request()->routeIs('calendar.index') ? 'has-link' : '' }}"
                        href="{{ route('calendar.index') }}">
                        <i class="fa fa-calendar"></i>
                        <span class="side-menu__label">Google Calendar</span>
                    </a>
                </li>

                {{-- Map --}}
                <li class="slide">
                    <a class="side-menu__item {{ request()->routeIs('map.global') ? 'has-link' : '' }}"
                        href="{{ route('map.global') }}">
                        <i class="fa fa-map"></i>
                        <span class="side-menu__label">Google Map</span>
                    </a>
                </li>

                {{-- track team --}}
                <li class="slide">
                    <a class="side-menu__item {{ request()->routeIs('admin.tracking') ? 'has-link' : '' }}"
                        href="{{ route('admin.tracking') }}">
                        <i class="fa fa-map"></i>
                        <span class="side-menu__label">Track Team</span>
                    </a>
                </li>

                {{-- Settings --}}
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 512 512">
                            <path
                                d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z" />
                        </svg>
                        <span class="side-menu__label">Settings</span>
                        <i class="angle fa fa-angle-right ms-auto"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('setting.general.index') }}" class="slide-item">General Settings</a></li>
                        <li><a href="{{ route('setting.profile.index') }}" class="slide-item">Profile Settings</a></li>
                    </ul>
                </li>
            </ul>


            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg>
            </div>
        </div>
    </div>
</div>
<!--/APP-SIDEBAR-->


{{-- sidebar style --}}
<style>
    /* Base menu item styling */
    .side-menu__item {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        color: #333;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .side-menu__item:hover {
        background-color: #f3f6f9;
        color: #38a3a5;
    }

    /* Icon alignment fix */
    .side-menu__item i,
    .side-menu__item svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        display: inline-block;
        text-align: center;
        margin-right: 10px;
        /* consistent spacing */
        color: inherit;
    }

    /* Label */
    .side-menu__label {
        flex: 1;
        display: inline-block;
    }

    /* Submenu items */
    .slide-menu .slide-item {
        display: block;
        color: #555;
        font-size: 14px;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .slide-menu .slide-item:hover {
        color: #38a3a5;
    }

    /* Optional: heading styling */
    .side-menu h3 {
        font-size: 13px;
        text-transform: uppercase;
        margin: 20px 15px 10px;
        color: #777;
        letter-spacing: 0.5px;
    }
</style>
