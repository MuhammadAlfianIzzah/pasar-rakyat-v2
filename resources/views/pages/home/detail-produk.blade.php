<x-main-layout>
    <div class="row px-5">
        <div class="col-6">
            <img style="width: 100%" src="{{ asset('storage') . '/' . $produk->logos[0]->gambar }}" alt="">
        </div>
        <div class="col-6 py-3">
            <div class="row">
                <div class="col-12">
                    <h4 class="mb-2">{{ $produk->nama }}</h4>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="alert alert-primary" role="alert">
                        <h3> Rp. {{ $produk->harga_max }}</h3>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-primary w-100">Masukkan Keranjang</button>
                <button type="button" class="btn btn-primary w-100">Beli Sekarang</button>
            </div>
        </div>
    </div>
</x-main-layout>
