<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="Thibitisha Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Thibitisha</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name ?? 'Administrator' }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <!-- User Management Header -->
                <li class="nav-header">USER MANAGEMENT</li>
                
                <!-- Roles Section -->
                <li class="nav-item {{ request()->is('admin/roles*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>
                            Roles
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" 
                               class="nav-link {{ request()->routeIs('admin.roles.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.create') }}" 
                               class="nav-link {{ request()->routeIs('admin.roles.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Role</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Users -->
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-header">Practitioner Mgt </li>
                <!--  Practitioners -->
                <li class="nav-item">
                    <a href="{{ route('practitioners.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p> Practitioners </p>
                    </a>
                </li>
                <li class="nav-header">Adminstration </li>
                <!-- Status -->
                <li class="nav-item">
                    <a href="{{ route('statuses.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>status</p>
                    </a>
                </li>
                <!-- Speciality -->
                <li class="nav-item">
                    <a href="{{ route('specialities.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Speciality</p>
                    </a>
                </li>
                <!-- Sub Speciality -->
                <li class="nav-item">
                    <a href="{{ route('subspecialities.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Sub Speciality</p>
                    </a>
                </li>
                <!-- Institution -->
                <li class="nav-item">
                    <a href="{{ route('institutions.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Institution</p>
                    </a>
                </li>
                <!-- Degrees -->
                <li class="nav-item">
                    <a href="{{ route('degrees.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Degrees</p>
                    </a>
                </li>
                <!-- Settings Header -->
                <li class="nav-header">SETTINGS</li>
                
                <!-- System Settings -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>System Settings</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>