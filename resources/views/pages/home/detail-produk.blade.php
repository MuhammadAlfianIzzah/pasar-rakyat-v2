<x-main-layout>
    <div class="container-fluid">

        <div class="row mt-4">
            <div class="col-lg-6 col-12">
                <img style="width: 100%;height: 350px;object-fit: contain"
                    src="{{ asset('storage') . '/' . $produk->logos[0]->gambar }}" alt="">
            </div>
            <div class="col-lg-6 col-12 py-3">
                <form class="w-100" action="{{ route('home-add-to-cart', [$produk->slug]) }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" class="price" name="price" value="{{ $harga }}">
                    <input type="hidden" class="produk_id" name="produk_id" value="{{ $produk->id }}">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="mb-2 py-2">{{ Str::headline($produk->nama) }}</h5>
                            @if ($produk->ratings->count() > 0)
                                <div>
                                    Rate:
                                    {{ $rating = $produk->ratings->sum('rating') / $produk->ratings->count() }}
                                    @for ($x = 1; $x <= $rating; $x++)
                                        <span class="h4 text-warning"><i class="fa-solid fa-star"></i></span>
                                    @endfor
                                    @for ($x = 1; $x <= ($lenght = 5 - floor($rating)); $x++)
                                        @if ($lenght == $x)
                                            {{-- {{ dd($lenght, $x) }} --}}
                                            @if (is_float($rating))
                                                <span class="h4 text-warning">
                                                    <i class="fa-solid fa-star-half-stroke"></i>
                                                </span>
                                            @else
                                                <span class="h4 text-warning">
                                                    <i class="fa-regular fa-star"></i>
                                                </span>
                                            @endif
                                        @else
                                            <span class="h4 text-warning">
                                                <i class="fa-regular fa-star"></i>
                                            </span>
                                        @endif
                                    @endfor
                                    |
                                    {{ $produk->ratings->count() }} Penilaian
                                    |
                                    {{ $produk->transaksis->count() }} Terjual
                                </div>
                            @else
                                <div>
                                    <span class="h4 text-warning">
                                        <i class="fa-regular fa-star"></i>
                                    </span> <span class="h4 text-warning">
                                        <i class="fa-regular fa-star"></i>
                                    </span> <span class="h4 text-warning">
                                        <i class="fa-regular fa-star"></i>
                                    </span> <span class="h4 text-warning">
                                        <i class="fa-regular fa-star"></i>
                                    </span> <span class="h4 text-warning">
                                        <i class="fa-regular fa-star"></i>
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-6">
                            <div class="h2 px-3"> Rp. {{ number_format($harga, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-6">
                            <div class="qty-container">
                                {{-- <span class="me-2">kuantitas</span> --}}
                                <button class="qty-btn-minus btn-light" type="button"><i
                                        class="fa fa-minus"></i></button>
                                <input type="text" name="quantity" value="1" class="input-qty" />
                                <button class="qty-btn-plus btn-light" type="button"><i
                                        class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if (empty(request('kupon')))
                                <div class="alert alert-primary" role="alert">
                                    <div class="nav-link tawar">Lakukan penawaran</div>
                                    <div class="count-tawar hide">
                                        <div class="form-floating py-2">
                                            <input type="number" name="harga_tawar" value="{{ $produk->harga_max }}"
                                                class="form-control" id="harga_tawar" placeholder="harga_tawar">
                                            <label for="harga_tawar">ajukan harga_tawar</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 d-flex gap-2">
                                                <button type="button" class="btn btn-outline-primary">Batal</button>
                                                <button type="submit" class="btn btn-primary check-penawaran"
                                                    data-action="{{ route('home-tawar-produk', [$produk->slug]) }}">check</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @if (request('kupon') && request('kupon') != $produk->kupon)
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Hai</strong> Kupon kamu sudah kadarluarsa
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @else
                                    @if (request()->harga < $produk->harga_min)
                                        <div class="alert alert-warning" role="alert">
                                            Tawaran Anda ditolak,
                                            <a href="{{ route('home-detailProduk', [$produk->slug]) }}">Tawar Ulang</a>
                                        </div>
                                    @else
                                        <div class="alert alert-success" role="alert">
                                            Anda Sudah Melakukan Penawaran -{{ $produk->harga_max - $harga }}
                                        </div>
                                    @endif

                                @endif

                            @endif

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-outline-primary w-100">Masukkan
                                    Keranjang</button>
                                <button type="button" class="btn btn-primary w-100">Beli Sekarang</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-2">
        <div class="p-3 px-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold"> {{ $produk->vendor->nama }}</h1>
                <p class="col-md-8 fs-4">{{ $produk->vendor->deskripsi }}</p>
                <a href="{{ route('home.detail.vendor', [$produk->vendor->slug]) }}" class="btn btn-primary btn-md"
                    type="button">Kunjungi Toko</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @forelse ($produk->vendor->produks()->paginate(10) as $pr)
                <div class="col-lg-3 col-6 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage') . '/' . $pr->logos[0]->gambar }}"
                            style="height: 150px;object-fit: contain" class="card-img-top"
                            alt="{{ $pr->nama }}">
                        <div class="card-body">
                            <p class="card-text">
                                <a href="{{ route('home-detailProduk', [$pr->slug]) }}">{{ $pr->nama }}</a>
                            </p>
                            <div class="row">
                                <div class="col-8">
                                    <small> Harga : Rp.{{ number_format($pr->harga_max, 0, ',', '.') }}</small>
                                </div>
                                <div class="col-4">
                                    <small>terjual : {{ $pr->transaksis->count() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center" role="alert">
                    Produk Belum Ada
                </div>
            @endforelse
        </div>
    </div>
    <div class="bg-light">
        <div class="container py-3 px-3">
            <form action="{{ route('home.rate.produk', [$produk->slug]) }}" method="POST">
                @method('POST')
                @csrf
                <div class="row">
                    <div class="col-12  justify-content-center d-flex align-items-center">
                        <div class="rating py-2">
                            <input type="radio" id="star5" name="rating" value="5" />
                            <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                            <input type="radio" id="star1" name="rating" value="1" />
                            <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
                        </div>
                        <br>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input name="kode_transaksi" class="form-control" id="kode_transaksi"
                                placeholder="name@example.com">
                            <label for="kode_transaksi  ">kode_transaksi </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input name="nama" class="form-control" id="nama"
                                placeholder="name@example.com">
                            <label for="nama">Nama</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="komentar" name="komentar"></textarea>
                                <label for="komentar">Comments</label>
                            </div>
                        </div>
                        <button class="btn w-100 btn-primary">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container-fluid">
        <div class="app container py-4">
            <div class="col-md-10 col-lg-8 m-auto">
                <div class="bg-white rounded-3 shadow-sm p-4">
                    <h4 class="mb-4">7 Comments</h4>
                    @forelse ($produk->ratings as $rate)
                        <div class="py-3 mb-2">
                            <div style="height: 50px" class="d-flex comment">
                                <img class="rounded-circle comment-img"
                                    src="https://via.placeholder.com/128/fe669e/ffcbde.png?text=S" />
                                <div class="flex-grow-1 ms-3">
                                    <div class="mb-1"><a href="#"
                                            class="fw-bold link-dark me-1">{{ $rate->user->name ?? 'anonym' }}</a>
                                        <span class="text-muted text-nowrap">
                                            Rate: {{ $penilaian = $rate->rating }}
                                            @for ($x = 1; $x <= $penilaian; $x++)
                                                <span class="h4 text-warning"><i class="fa-solid fa-star"></i></span>
                                            @endfor
                                            @for ($x = 1; $x <= 5 - $penilaian; $x++)
                                                <span class="h4 text-warning">
                                                    <i class="fa-regular fa-star"></i>
                                                </span>
                                            @endfor

                                        </span>
                                    </div>
                                    <div class="mb-2">{{ $rate->komentar }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(".check-penawaran").on('click', function(e) {
                e.preventDefault();
                //serializing form data
                var formData = $("#harga_tawar").val();
                // console.log("oek", formData)
                var ajaxUrl = $(this).data('action');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: ajaxUrl,
                    data: {
                        "harga_tawar": formData
                    },
                    method: "POST",
                    success: function(data) {
                        window.location.href = data;
                    },
                    error: function(data) {
                        console.log(data.responseText)
                        // window.location.href = data;
                    }
                });
            });
        </script>
    @endpush
</x-main-layout>
