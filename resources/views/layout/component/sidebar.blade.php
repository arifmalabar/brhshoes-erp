<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-success">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="{{ asset('assets/dist/img/KOS.png') }}" alt="AdminLTE Logo" class="brand-image"
            style="width: 40px; height: auto;">
        <span class="brand-text font-weight-bold">BRHShoes</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img style="margin-top: 10px;" src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="/profile" class="d-block">Bahrul</a>
                <span class="right badge badge-success">Admin</span>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-header">Menu Utama</li>

                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ $nama == 'dashboard' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/manufacturing" class="nav-link {{ $nama == 'manufacturing' ? 'active' : '' }}">
                        <i class="fas nav-icon fa-box"></i>
                        <p>Produk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/manufacturing" class="nav-link {{ $nama == 'bahan' ? 'active' : '' }}">
                        <i class="fas nav-icon fa-industry"></i>
                        <p>Bahan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/bill_material" class="nav-link {{ $nama == 'bom' ? 'active' : '' }}">
                        <i class="fas nav-icon fa-money-bill"></i>
                        <p>Bill Of Material</p>
                    </a>
                </li>
                
                <li class="nav-header">Laporan</li>
                
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
