<x-main-layout>
    <div class="px-5 py-3 mb-4 bg-light rounded-3">
        <div class="container-fluid py-3">
            <form action="" method="GET">
                <div class="input-group">
                    <input type="search" class="form-control rounded" name="search" placeholder="Search"
                        aria-label="Search" aria-describedby="search-addon" />
                    <button type="submit" class="btn btn-outline-primary">search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @forelse ($produks as $pr)
                <div class="col-lg-3 col-6 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage') . '/' . $pr->logos[0]->gambar }}"
                            style="height: 150px;object-fit: contain" class="card-img-top" alt="{{ $pr->nama }}">
                        <div class="card-body">
                            <p class="card-text">
                                <a href="{{ route('home-detailProduk', [$pr->slug]) }}">{{ $pr->nama }}</a>
                            </p>
                            <div class="row">
                                <div class="col-6">
                                    <small> Harga : {{ $pr->harga_max }}</small>
                                </div>
                                <div class="col-6">
                                    <small>terjual : 0</small>
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
</x-main-layout>
