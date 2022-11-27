<x-main-layout>
    <section class="h-100 h-custom ">
        <div class="container-fluid py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-8 col-md-8">
                                    <h5 class="mb-3"><a href="{{ route('home-produk') }}" class="text-body">
                                            <i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a>
                                    </h5>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <p class="mb-1">Shopping cart</p>
                                            <p class="mb-0">Daftar belanjaan Anda</p>
                                        </div>
                                    </div>
                                    @forelse ($cartItems as  $cart)
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-8">
                                                        <div class="row">
                                                            <div class="col-12 col-md-4 align-items-center d-flex">
                                                                <img src="{{ asset('storage') . '/' . $cart->attributes->image }}"
                                                                    class="img-thumbnail"
                                                                    alt="Shopping item"style="width: 100%;height:100px;object-fit:contain">
                                                            </div>
                                                            <div class="col-12 col-md-8 align-items-center d-flex">
                                                                <div class="py-2 ">
                                                                    <div class="h6">{{ $cart->name }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4 d-flex flex-row align-items-center">
                                                        <div style="width: 50px;">
                                                            <h5 class="fw-normal mb-0">{{ $cart->quantity }}</h5>
                                                        </div>
                                                        <div style="width: 140px;">
                                                            <h5 class="mb-0">Rp.
                                                                {{ number_format($cart->price, 0, ',', '.') }}</h5>
                                                        </div>
                                                        <form method="POST"
                                                            action="{{ route('home-remove-to-cart', [$cart->id]) }}">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn"
                                                                onclick="return confirm('anda yakin menghapusnya?')">
                                                                <i class="fas fa-trash-alt text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="alert alert-warning" role="alert">
                                            Keranjang Masih Kosong
                                        </div>
                                    @endforelse
                                </div>
                                <div class="col-lg-4 col-md-4">

                                    <div class="card border-0  shadow-sm rounded-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="mb-0">Invoice</h5>
                                                <div>*Harga belum termasuk ongkir*</div>
                                            </div>

                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Total</p>
                                                <p class="mb-2">Rp. {{ number_format(Cart::getTotal(), 0, ',', '.') }}
                                                </p>
                                            </div>
                                            @if (count($cartItems) > 0)
                                                <form class="d-inline" action="{{ route('home-clear-cart') }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-danger">Bersihkan
                                                        Keranjang</button>
                                                </form>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">
                                                    Checkout
                                                </button>
                                            @endif
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <form action="{{ route('home.transaksi.store') }}" method="POST">
                                                        @method('POST')
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                    Keranjang Pesanan</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="nama"
                                                                        class="form-label">Nama</label>
                                                                    <input type="text" value="{{ old('nama') }}"
                                                                        name="nama" class="form-control"
                                                                        id="nama">
                                                                    @error('nama')
                                                                        <small
                                                                            class="form-text text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <textarea style="min-height: 80px" name="alamat" class="form-control" placeholder="Alamat Lengkap" id="alamat"></textarea>
                                                                    <label for="alamat">Alamat Lengkap</label>
                                                                    @error('alamat')
                                                                        <small
                                                                            class="form-text text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="kota"
                                                                                class="form-label">Kota</label>
                                                                            <input type="text"
                                                                                value="{{ old('kota') }}"
                                                                                name="kota" class="form-control"
                                                                                id="kota">
                                                                            @error('kota')
                                                                                <small
                                                                                    class="form-text text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">
                                                                            <label for="kecamatan"
                                                                                class="form-label">Kecamatan</label>
                                                                            <input type="text"
                                                                                value="{{ old('kecamatan') }}"
                                                                                name="kecamatan" class="form-control"
                                                                                id="kecamatan">
                                                                            @error('kecamatan')
                                                                                <small
                                                                                    class="form-text text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="nomor_hp" class="form-label">Nomor
                                                                        Handphone</label>
                                                                    <input type="text"
                                                                        value="{{ old('nomor_hp') }}" name="nomor_hp"
                                                                        class="form-control" id="nomor_hp">
                                                                    @error('nomor_hp')
                                                                        <small
                                                                            class="form-text text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main-layout>
