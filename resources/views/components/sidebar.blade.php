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

    <!-- Divider -->
    <hr class="sidebar-divider">

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


    @if (auth()->user()->user_group_id == 1 || auth()->user()->user_group_id == 99)
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
                <i class="fas fa-fw fa-cog"></i>
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
        <hr class="sidebar-divider">
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
