<x-admin-layout>
    @push('script')
        @if ($errors->any())
            <script>
                $('#createProduk').modal('show');
            </script>
        @endif
    @endpush
    <div class="row">
        <div class="col-6">
            <h4 class="text-dark">Kelola Data Kategori Produk</h4>
        </div>
        <div class="col-6">
            <div class="input-group rounded">
                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                    aria-describedby="search-addon" />
                <span class="input-group-text border-0" id="search-addon">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="row mt-4 mb-2">
        <div class="col-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createProduk">
                <i class="fa-solid fa-plus"></i> Tambah Data
            </button>

            <!-- Modal -->
            <div class="modal fade" id="createProduk" tabindex="-1" aria-labelledby="createProdukLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('kategori-produk-store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="modal-header">
                                <h5 class="modal-title" id="createProdukLabel">Tambah Data Kategori Produk</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" value="{{ old('nama') }}" name="nama"
                                        class="form-control" id="nama">
                                    @error('nama')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('deskripsi') }}</textarea>

                                    @error('deskripsi')
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
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">batalkan</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row bg-white px-3 py-4">
        <div class="col-12">
            <table class="table">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">nama</th>
                        <th scope="col">deskripsi</th>
                        <th scope="col">logo</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategori_produks as $key => $kategori_produk)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $kategori_produk->nama }}</td>
                            <td>{{ $kategori_produk->deskripsi }}</td>
                            <td>
                                <img style="width: 50px" alt="logo"
                                    src="{{ asset('storage') . '/' . $kategori_produk->logo }}" alt="">
                            </td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('kategori-produk-edit', [$kategori_produk->slug]) }}"
                                        class="btn btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('kategori-produk-destroy', [$kategori_produk->slug]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('anda yakin untuk menghapusnya?')">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th scope="row" colspan="4">Data kosong</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="justify-content-center d-flex">
                {{ $kategori_produks->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
