<x-main-layout>
    <div class="px-5 py-3 mb-4 bg-light rounded-3">
        @if (request('search') || request('kategori_id'))
            <div class="alert shadow-sm text-center" role="alert">
                <h3> {{ request('search') ?? '💢' }} -- {{ request('kategori_id') ?? '💢' }}</h3>
            </div>
        @endif
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
            @forelse ($vendors as $vd)
                <div class="col-lg-3 col-6 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage') . '/' . $vd->logo }}" style="height: 150px;object-fit: contain"
                            class="card-img-top" alt="{{ $vd->nama }}">
                        <div class="card-body">
                            <p class="card-text">
                                <a href="{{ route('home.detail.vendor', [$vd->slug]) }}">{{ $vd->nama }}</a>
                            </p>
                            <div class="row">
                                <div class="col-12">
                                    <p>{{ $vd->deskripsi }}</p>
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
