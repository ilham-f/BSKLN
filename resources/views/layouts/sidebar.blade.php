<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="https://kemlu.go.id/images/logo_kemenlu.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">BSKLN</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="/" class="nav-link {{ ($title === 'Dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/tabel-negara" class="nav-link {{ ($title === 'Tabel Negara') ? 'active' : '' }}">
                <i class="nav-icon fas fa-table"></i>
                <p>
                Tabel Negara
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/tabel-kawasan" class="nav-link {{ ($title === 'Tabel Kawasan') ? 'active' : '' }}">
                <i class="nav-icon fas fa-table"></i>
                <p>
                Tabel Kawasan
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/tabel-direktorat" class="nav-link {{ ($title === 'Tabel Direktorat') ? 'active' : '' }}">
                <i class="nav-icon fas fa-table"></i>
                <p>
                Tabel Direktorat
            </p>
            </a>
        </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
