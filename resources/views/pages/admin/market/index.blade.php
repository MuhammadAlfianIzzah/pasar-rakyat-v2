<x-admin-layout>
    <div class="row">
        <div class="col-12">
            <div class="py-3 px-5 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">{{ $vendor->nama }}</h1>
                    <p class="col-md-8 fs-4">{{ $vendor->deskripsi }}</p>
                    <a href="{{ route('produk-index') }}" class="btn btn-primary">Kelola Produk</a>
                    <a href="{{ route('market.edit', [$vendor->slug]) }}" class="btn btn-warning">Edit Profile</a>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="row pb-4">
        @foreach ($vendor->produks as $produk)
            <div class="col-lg-4">
                <div class="card">
                    <img src="{{ asset('storage/') . '/' . $produk->logos[0]->gambar }}" class="card-img-top"
                        alt="{{ $produk->slug }}">
                    <div class="card-body">
                        <p class="card-text">
                            <a href="{{ route('home-detailProduk', [$produk->slug]) }}">{{ $produk->nama }}</a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-admin-layout>
