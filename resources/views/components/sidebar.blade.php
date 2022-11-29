<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-left-long"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Halaman Utama</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    @if (auth()->user()->user_group_id == 1 || auth()->user()->user_group_id == 99)
        <!-- Divider -->

        <!-- Heading -->
        <div class="sidebar-heading">
            Menu Admin
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-claimTrasaksi') }}">
                <i class="fa-brands fa-get-pocket"></i>
                <span>Claim Trasaksi</span></a>
        </li>

        <hr class="sidebar-divider">
    @endif
    @if (auth()->user()->user_group_id == 99)
        <!-- Heading -->
        <div class="sidebar-heading">
            Menu Superadmin
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Settings</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">-- Setting</h6>
                    <a class="collapse-item" href="{{ route('negara-index') }}">
                        Negara
                    </a>
                    <a class="collapse-item" href="{{ route('provinsi-index') }}">
                        Provinsi
                    </a>
                    <a class="collapse-item" href="{{ route('kabupaten-index') }}">
                        Kabupaten
                    </a>
                    <h6 class="collapse-header">-- Produk</h6>
                    <a class="collapse-item" href="{{ route('kategori-produk-index') }}">
                        Kategori Produk
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin-kabupaten-index') }}">
                <i class="fa-brands fa-get-pocket"></i>
                <span>Set Admin Kabupaten</span></a>
        </li>
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fa-solid fa-list-check"></i>
                <span>Kelola</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelola:</h6>
                    <a class="collapse-item" href="{{ route('vendor-index') }}">Vendors</a>
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
    @endif
    @if (auth()->user()->vendor->count() > 0 && auth()->user()->user_group_id == 2)
        <!-- Heading -->
        <div class="sidebar-heading">
            Market
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#market"
                aria-expanded="true" aria-controls="market">
                <i class="fa-solid fa-shop"></i>
                <span>Market</span>
            </a>

            <div id="market" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">-- Market</h6>
                    <a class="collapse-item" href="{{ route('market.index', [auth()->user()->vendor[0]->slug]) }}">
                        Kelola Toko
                    </a>
                    <a class="collapse-item" href="{{ route('produk-index') }}">
                        Produk
                    </a>
                </div>
            </div>
        </li>
        <!-- Divider -->
    @endif



    <div class="sidebar-heading">
        History
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksi"
            aria-expanded="true" aria-controls="transaksi">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span>Transaksi</span>
        </a>

        <div id="transaksi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">-- Market</h6>
                <a class="collapse-item" href="{{ route('history.transaksi') }}">
                    Riwayat Transaksi
                </a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
