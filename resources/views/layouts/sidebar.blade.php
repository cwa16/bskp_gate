@php
    $currentRoute = Route::currentRouteName();
@endphp
<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/proyek-baru-lagi.png') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ Str::startsWith($currentRoute, 'dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>

                <li class="nav-item {{ Str::startsWith($currentRoute, 'app-link-index') ? 'active' : '' }}">
                    <a href="{{ route('app-link-index') }}">
                        <i class="fas fa-server"></i>
                        <p>App</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-item {{ Str::startsWith($currentRoute, 'news-index') ? 'active' : '' }}">
                    <a href="{{ route('news-index') }}">
                        <i class="fas fa-newspaper"></i>
                        <p>News</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-item {{ Str::startsWith($currentRoute, 'buletin.index') ? 'active' : '' }}">
                    <a href="{{ route('buletin.index') }}">
                        <i class="fab fa-telegram-plane"></i>
                        <p>Buletin</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Users</h4>
                </li>

                <li class="nav-item {{ Str::startsWith($currentRoute, 'recent-activity-index') ? 'active' : '' }}">
                    <a href="{{ route('recent-activity-index') }}">
                        <i class="fas fa-inbox"></i>
                        <p>Recent Activity</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-item {{ Str::startsWith($currentRoute, 'activity-log-index') ? 'active' : '' }}">
                    <a href="{{ route('activity-log-index') }}">
                        <i class="fas fa-walking"></i>
                        <p>Activity Log</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-item {{ Str::startsWith($currentRoute, 'user-account-index') ? 'active' : '' }}">
                    <a href="{{ route('user-account-index') }}">
                        <i class="fas fa-users"></i>
                        <p>User Account</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-item {{ Str::startsWith($currentRoute, 'user-role-index') ? 'active' : '' }}">
                    <a href="{{ route('user-role-index') }}">
                        <i class="fas fa-users-cog"></i>
                        <p>User Role</p>
                        <span class="caret"></span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
