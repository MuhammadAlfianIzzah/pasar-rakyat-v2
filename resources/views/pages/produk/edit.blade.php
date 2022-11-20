<x-admin-layout>
    @push('script')
        @if ($errors->any())
            <script>
                $('#createNegara').modal('show');
            </script>
        @endif
    @endpush
    <div class="row">
        <div class="col-6">
            <h4 class="text-dark">Edit Data Produk {{ $produk->nama }}</h4>
        </div>
        <div class="col-6">

        </div>
    </div>
    <div class="row mt-4 mb-2 bg-white py-4 px-4">
        <form class="col-12" action="{{ route('produk-update', [$produk->slug]) }}" method="POST"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" value="{{ old('nama') ?? ($produk->nama ?? '') }}" name="nama"
                    class="form-control" id="nama">
                @error('nama')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('deskripsi') ?? ($produk->deskripsi ?? '') }}</textarea>

                @error('deskripsi')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="kategori_produk">Kategori Produk</label>
                <select class="custom-select" name="kategori_produk">
                    @foreach ($kategoris as $kategori)
                        <option
                            {{ $kategori->id == $produk->kategori_produk || old('kategori_produk') ? 'selected' : '' }}
                            value="{{ $kategori->id }}">
                            {{ $kategori->nama }}</option>
                    @endforeach
                </select>
                @error('kategori_produk')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" value="{{ old('stok') ?? ($produk->stok ?? '') }}" name="stok"
                    class="form-control" id="stok">
                @error('stok')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="custom-file  mb-3">
                <input type="file" class="custom-file-input" id="logo" name="logo">
                <label class="custom-file-label" for="logo">Choose file</label>
                @error('logo')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col">
                    <input type="number" value="{{ old('harga_min') ?? ($produk->harga_min ?? '') }}"
                        class="form-control" placeholder="harga_min ..." name="harga_min">
                    @error('harga_min')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col">
                    <input type="number" value="{{ old('harga_max') ?? ($produk->harga_max ?? '') }}"
                        class="form-control" placeholder="harga_max ..." name="harga_max">
                    @error('harga_max')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('negara-index') }}" class="btn btn-dark mr-2">
                    Back
                </a>
                <button type="submit" class="btn btn-warning">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
