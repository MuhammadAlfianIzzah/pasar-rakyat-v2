 <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
     <div class="offcanvas-header">

         <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
     </div>
     <div class="offcanvas-body d-flex flex-column flex-shrink-0 p-3">
         <div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
             <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                 <i class="fas fa-bars"></i>
                 <span class="fs-5 fw-semibold ms-2"> Menu</span>
             </a>
             <ul class="list-unstyled ps-0">
                 <li class="mb-1">
                     <a class="nav-link text-dark fs-6" href="{{ route('home') }}">Home</a>
                 </li>
                 <li class="mb-1">
                     <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                         data-bs-target="#posts" aria-expanded="false">
                         Posts
                     </button>
                     <div class="collapse" id="posts">
                         <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                             {{-- <li><a href="{{ route('my-brain') }}" class="link-dark rounded py-2">My brain</a></li>
                             <li><a href="{{ route('show-posts') }}" class="link-dark rounded py-2 active">Post</a>
                             </li> --}}
                         </ul>
                     </div>
                 </li>
                 <li class="mb-1">
                     <a class="nav-link text-dark fs-6" href="{{ route('home-produk') }}">Belanja</a>
                 </li>
                 <li class="mb-1">
                     <a class="nav-link top-nav active" aria-current="page"
                         href="{{ route('home-daftar-vendor') }}">Daftar
                         Vendor</a>
                 </li>

                 @if (Auth::check())
                     <li class="nav-item">
                         <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                     </li>

                     <form action="{{ route('logout') }}" method="POST">
                         @csrf
                         @method('post')
                         <button type="submit" class="btn btn-danger">Logout</button>

                     </form>
                 @else
                     <li class="nav-item">
                         <a href="{{ route('login') }}" class="nav-link">Login</a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('register') }}" class="nav-link">Register</a>
                     </li>
                 @endif
             </ul>
         </div>

     </div>
 </div>
 <div class="">
     <nav class="navbar navbar-expand-lg bg-light navbar-light">
         <div class="container">
             <button class="btn btn-primary navbar-toggler" type="button" data-bs-toggle="offcanvas"
                 data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">

                 <svg class="img-fluid" width="20" height="20" viewBox="0 0 394 282" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                     <rect x="80" width="314" height="74" rx="20" fill="white" />
                     <path
                         d="M0 124C0 112.954 8.95431 104 20 104H374C385.046 104 394 112.954 394 124V158C394 169.046 385.046 178 374 178H20C8.9543 178 0 169.046 0 158V124Z"
                         fill="white" />
                     <path
                         d="M0 228C0 216.954 8.95431 208 20 208H304C315.046 208 324 216.954 324 228V262C324 273.046 315.046 282 304 282H20C8.95431 282 0 273.046 0 262V228Z"
                         fill="white" />
                     <circle cx="367.5" cy="245.5" r="26.5" fill="#18A0DC" />
                     <circle cx="27" cy="37" r="27" fill="#FF969A" />
                 </svg>
                 Menu
             </button>

             <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">

                 <ul class="navbar-nav">

                     <li class="nav-item">
                         <a class="nav-link top-nav {{ Request::routeIs('home') ? 'active fw-semibold' : '' }}"
                             aria-current="page" href="{{ route('home') }}">Home</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link top-nav {{ Request::routeIs('home-produk') ? 'active fw-semibold' : '' }}"
                             href="{{ route('home-produk') }}">Belanja</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link top-nav top-nav {{ Request::routeIs('home-daftar-vendor') ? 'active fw-semibold' : '' }}"
                             aria-current="page" href="{{ route('home-daftar-vendor') }}">Daftar
                             Vendor</a>

                     </li>
                 </ul>
                 <ul class="navbar-nav">
                     @if (Auth::check())
                         <li class="nav-item">
                             <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                         </li>

                         <form action="{{ route('logout') }}" method="POST">
                             @csrf
                             @method('post')
                             <button type="submit" class="btn btn-danger">Logout</button>

                         </form>
                     @else
                         <li class="nav-item">
                             <a href="{{ route('login') }}" class="nav-link">Login</a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('register') }}" class="nav-link">Register</a>
                         </li>
                     @endif

                 </ul>
             </div>
         </div>
     </nav>
     <nav class="navbar navbar-dark" style="background-color: #FFE2C1">
         <div class="container">
             <a class="navbar-brand" href="{{ route('home') }}">
                 <img src="{{ asset('logo.png') }}" style="height: 50px" alt="pasarakyat">
             </a>
             <div class="d-flex">
                 <a href="{{ route('cart.list') }}" class="btn btn-light">
                     <i class="fa-solid fa-cart-shopping"></i> <span class="badge text-bg-secondary">
                         {{ count(Cart::getContent()) }}
                     </span>
                 </a>
             </div>
         </div>
     </nav>

 </div>
