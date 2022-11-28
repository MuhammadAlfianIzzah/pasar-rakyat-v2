<x-main-layout>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="h-100 p-2 text-bg-white rounded-3">
                {{-- <h4 class="py-4">Vendor Pasar Rakyat</h4> --}}
                <div id="map" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 class="py-4 text-center">Vendor Pasar Rakyat</h4>
            </div>
        </div>
        <div class="row justify-content-center">
            @forelse ($vendors as $vendor)
                <div class="col-lg-4 mb-2 col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header">
                            <img style="height: 150px;object-fit: contain"
                                src="{{ asset('storage') . '/' . $vendor->logo }}" class="card-img-top"
                                alt="{{ $vendor->slug }}">
                        </div>
                        <div class="card-body">
                            <a href="{{ route('home.detail.vendor', [$vendor->slug]) }}"
                                class="card-title">{{ $vendor->nama }}</a>
                            <p class="card-text">{{ $vendor->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center" role="alert">
                    Vendor Belum Ada
                </div>
            @endforelse
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 class="py-4 text-center">Kategori Produk</h4>
            </div>
        </div>
        <div class="row justify-content-center">
            @forelse ($kategoris as $kategori)
                <div class="col-lg-2 col-4 mb-4">
                    <div class="card">
                        <img style="height: 100px;object-fit: contain"
                            src="{{ asset('storage') . '/' . $kategori->logo }}" class="card-img-top"
                            alt="{{ $kategori->slug }}">
                        <div class="card-body">
                            <p class="card-text h6">{{ $kategori->nama }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center" role="alert">
                    Kategori Produk Belum Ada
                </div>
            @endforelse
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h4 class="py-4">Produk Terlaris</h4>
            </div>
        </div>
        <div class="row">
            @forelse ($produk_terlaris as $pr)
                <div class="col-lg-3 col-6 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage') . '/' . $pr->logos[0]->gambar }}"
                            style="height: 150px;object-fit: contain" class="card-img-top" alt="{{ $pr->nama }}">
                        <div class="card-body">
                            <p class="card-text">
                                <a href="{{ route('home-detailProduk', [$pr->slug]) }}">{{ $pr->nama }}</a>
                            </p>
                            <div class="row">
                                <div class="col-8">
                                    <small> Harga : <span class="fw-bold text-danger">Rp.
                                            {{ number_format($pr->harga_max, 0, ',', '.') }}</span></small>
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

    @push('script')
        <script>
            var vendor = @json($map_vendor);
            var LeafIcon = L.Icon.extend({
                options: {
                    shadowUrl: 'leaf-shadow.png',
                    iconSize: [45, 45],
                    shadowSize: [45, 45],
                    iconAnchor: [45, 45],
                }
            });
            var locations = [];
            vendor.forEach((vend) => {
                locations.push([vend.nama, vend.lat, vend.lang, vend.deskripsi, @json(asset('storage')) + "/" +
                    vend.logo
                ])
            })
            var greenIcon = new LeafIcon({
                iconUrl: 'https://img.freepik.com/free-vector/marketplace-concept-illustration_114360-7002.jpg?w=740&t=st=1668728772~exp=1668729372~hmac=29cb11b21cf476968311645f40545f480b9d320eee0ecb92a44afe119fd037ac'
            });


            var map = L.map('map', {
                // Set latitude and longitude of the map center (required)
                center: [-3.984370090705739, 122.50798720432785],
                // Set the initial zoom level, values 0-18, where 0 is most zoomed-out (required)
                zoom: 10
            });
            mapLink =
                '<a href="http://openstreetmap.org">OpenStreetMap</a>';
            L.tileLayer(
                'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; ' + mapLink + ' Contributors',
                    maxZoom: 18,
                }).addTo(map);

            for (var i = 0; i < locations.length; i++) {
                marker = new L.marker([locations[i][1], locations[i][2]], {
                        icon: greenIcon
                    })
                    .bindPopup(
                        `<div class="card" style="width: 18rem;">
                    <img style="height:100px;object-fit:contain" src="${locations[i][4]}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">${locations[i][0]}</h5>
                        <p class="card-text">${locations[i][3]}</p>
                       <div class="d-flex gap-2">
                         <a href="#" class="h4"><i class="fa-solid fa-eye"></i></a>
                          <a href="#" class="h4"><i class="fa-solid fa-map-location-dot"></i></a>
                        </div>
                    </div>
                    </div>`
                    )
                    .addTo(map);
            }
        </script>
    @endpush
</x-main-layout>
