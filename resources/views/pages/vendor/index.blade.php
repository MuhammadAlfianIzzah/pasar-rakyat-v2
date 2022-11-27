<x-admin-layout>
    @push('script')
        @if ($errors->any())
            <script>
                $('#createVendor').modal('show');
            </script>
        @endif
    @endpush
    <div class="row">
        <div class="col-6">
            <h4 class="text-dark">Kelola Data Vendors</h4>
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createVendor">
                <i class="fa-solid fa-plus"></i> Tambah Data
            </button>

            <!-- Modal -->
            <div class="modal fade" id="createVendor" tabindex="-1" aria-labelledby="createVendorLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('vendor-store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="modal-header">
                                <h5 class="modal-title" id="createVendorLabel">Tambah Data Vendors</h5>
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
                                    <label for="nomor_hp">Nomor Hp</label>
                                    <input type="text" value="{{ old('nomor_hp') }}" name="nomor_hp"
                                        class="form-control" id="nomor_hp">
                                    @error('nomor_hp')
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
                                <div class="form-group">
                                    <label for="alamat_lengkap">Alamat</label>
                                    <textarea name="alamat_lengkap" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('alamat_lengkap') }}</textarea>

                                    @error('alamat_lengkap')
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
                                        <input type="text" value="{{ old('lat') }}" class="form-control"
                                            placeholder="lat ..." name="lat">
                                        @error('lat')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <input type="text" value="{{ old('lang') }}" class="form-control"
                                            placeholder="lang ..." name="lang">
                                        @error('lang')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kabupaten_id">Provinsi</label>
                                    <select class="custom-select" name="kabupaten_id">
                                        @foreach ($kabupatens as $kabupaten)
                                            <option value="{{ $kabupaten->id }}">{{ $kabupaten->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kabupaten_id')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="user_id">User</label>
                                    <select class="custom-select" name="user_id">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="1"
                                        {{ old('is_core') == 1 ? 'checked' : '' }} type="checkbox" id="is_core"
                                        name="is_core">
                                    <label class="form-check-label" for="is_core">
                                        apakah vendor ini merupakan pusat dikota mereka?
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">batalkan</button>
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
                        <th scope="col">Lokasi</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vendors as $key => $vendor)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $vendor->nama }}</td>
                            <td>{{ $vendor->deskripsi }}</td>
                            <td>
                                <img style="width: 50px" alt="logo"
                                    src="{{ asset('storage') . '/' . $vendor->logo }}" alt="">
                            </td>
                            <td>{{ $vendor->lat }} {{ $vendor->lang }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('vendor-edit', [$vendor->slug]) }}" class="btn btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('vendor-destroy', [$vendor->slug]) }}" method="POST">
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
                {{ $vendors->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
