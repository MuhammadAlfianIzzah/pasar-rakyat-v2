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
                    <input type="search" value="{{ request('search') }}" class="form-control rounded" name="search"
                        placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <select name="kategori_id" style="max-width: 60px" class="form-select select-2"
                        aria-label="Default select example">
                        @foreach ($kategoris as $kt)
                            <option value="">Select Kategori</option>
                            <option {{ request('kategori_id') == $kt->id ? 'selected' : '' }}
                                value="{{ $kt->id }}">{{ $kt->nama }}</option>
                        @endforeach
                    </select>
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
                    Produk Tidak Ditemukan
                </div>
            @endforelse
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                // Select2 Multiple
                $('.select-2').select2({
                    placeholder: "Select kategori",
                    allowClear: true,
                    theme: 'bootstrap-5'
                });

            });
        </script>
    @endpush
</x-main-layout>
