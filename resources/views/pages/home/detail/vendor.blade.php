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
                                                <td>Jumlah Produk: {{ $vendor->produks->count() }}</td>
                                                <td>Bergabung: {{ $vendor->created_at }}</td>

                                            </tr>
                                            <tr>
                                                <td>Contact Admin:
                                                    {{ $vendor->kabupaten->adminPasarKabupaten->nomor_hp ?? '-' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 card py-4">
                <h2 class="text-center"> Alamat:</h2>
                <div class="text-center">
                    {{ $vendor->alamat_lengkap }} <span class="badge text-bg-primary">Kabupaten</span>
                    {{ $vendor->kabupaten->nama }}
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
            var vendor = @json($vendor);
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
                [vendor.nama, vendor.lat, vendor.lang, vendor.deskripsi, @json(asset('storage')) + "/" +
                    vendor.logo
                ],
            ];

            var map = L.map('map', {
                // Set latitude and longitude of the map center (required)
                center: [locations[0][1], locations[0][2]],
                // Set the initial zoom level, values 0-18, where 0 is most zoomed-out (required)
                zoom: 13
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
