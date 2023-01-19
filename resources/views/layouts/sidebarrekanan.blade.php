<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/dashboard/index" class="nav-link {{ (request()->is('dashboard/index')) ? 'active' : ' ' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/datapelanggan/index" class="nav-link {{ (request()->is('datapelanggan/index')) ? 'active' : ' ' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Pelanggan</p>
                </a>
                </li>
                <li class="nav-item">
                    <a href="/datarekanan/index" class="nav-link {{ (request()->is('datarekanan/index')) ? 'active' : ' ' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Rekanan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/databarang/index" class="nav-link {{ (request()->is('databarang/index')) ? 'active' : ' ' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dataharga/index" class="nav-link {{ (request()->is('dataharga/index')) ? 'active' : ' ' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Harga</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/datauser/index" class="nav-link {{ (request()->is('datauser/index')) ? 'active' : ' ' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data User</p>
                    </a>
                </li>
            </ul>
            </li> --}}
            {{-- <li class="nav-item">
                    <a href="/transaksipenjualan/index" class="nav-link {{ (request()->is('transaksipenjualan/index')) ? 'active' : ' ' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Transaksi Penjualan
                {{-- <span class="right badge badge-danger">New</span> --}}
                {{-- </p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="/transaksicuci/index" class="nav-link {{ (request()->is('transaksicuci/index')) ? 'active' : ' ' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Transaksi Cuci
                    {{-- <span class="right badge badge-danger">New</span> --}}
                    {{-- </p>
                    </a>
                </li> --}}
                    {{-- <li class="nav-item">
                    <a href="/transaksikas/index" class="nav-link {{ (request()->is('transaksikas/index')) ? 'active' : ' ' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Transaksi Kas
                        {{-- <span class="right badge badge-danger">New</span> --}}
                        {{-- </p>
                    </a>
                </li> --}}
                        <li class="nav-item">
                            <a href="/closing/index" class="nav-link {{ (request()->is('closing/index')) ? 'active' : ' ' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Closing
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/report/index" class="nav-link {{ (request()->is('report/index')) ? 'active' : ' ' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Report
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
