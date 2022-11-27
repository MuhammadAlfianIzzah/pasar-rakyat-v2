<x-main-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="h-100 p-2 text-bg-white rounded-3">
                    {{-- <h4 class="py-4">Vendor Pasar Rakyat</h4> --}}
                    <div id="map" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-4">
                            <img src="{{ asset('storage') . '/' . $vendor->logo }}" class="img-fluid rounded-start"
                                alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $vendor->nama }}</h5>
                                <p>{{ $vendor->deskripsi }}</p>
                                <div class="d-flex justify-content-between">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Produk: 10</td>
                                                <td>Bergabung: 30 Bulan Lalu</td>
                                                <td>Mengikuti: 11</td>
                                            </tr>
                                            <tr>
                                                <td>Produk: 10</td>
                                                <td>Bergabung: 30 Bulan Lalu</td>
                                                <td>Mengikuti: 11</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h5 class="py-3 text-center">Kamu mungkin suka</h5>
            @forelse ($vendor->produks as $pr)
                <div class="col-lg-3 col mb-4">
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
    @push('script')
        <script>
            var LeafIcon = L.Icon.extend({
                options: {
                    shadowUrl: 'leaf-shadow.png',
                    iconSize: [45, 45],
                    shadowSize: [45, 45],
                    iconAnchor: [45, 45],
                    // shadowAnchor: [4, 45],
                    // popupAnchor: [-3, -76]
                }
            });
            var greenIcon = new LeafIcon({
                iconUrl: 'https://img.freepik.com/free-vector/marketplace-concept-illustration_114360-7002.jpg?w=740&t=st=1668728772~exp=1668729372~hmac=29cb11b21cf476968311645f40545f480b9d320eee0ecb92a44afe119fd037ac'
            });
            var locations = [
                ["LOCATION_1", -3.9638055527204843, 122.5101055255384],
            ];

            var map = L.map('map', {
                // Set latitude and longitude of the map center (required)
                center: [-3.9638055527204843, 122.5101055255384],
                // Set the initial zoom level, values 0-18, where 0 is most zoomed-out (required)
                zoom: 14
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
                        "<p1><b>The White House</b><br>Landmark, historic home & office of the United States president, with tours for visitors.</p1>"
                    )
                    .addTo(map);
            }
        </script>
    @endpush
</x-main-layout>
