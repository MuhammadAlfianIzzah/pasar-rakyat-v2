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
            <h4 class="text-dark">Kelola Data Admin Kabupaten</h4>
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
                        <form action="{{ route('admin-kabupaten-store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="modal-header">
                                <h5 class="modal-title" id="createVendorLabel">Tambah Data Admin Kabupaten</h5>
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
                                    <label for="kabupaten_id">Kabupaten</label>
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
                        <th scope="col">Nama</th>
                        <th scope="col">Nomor Hp</th>
                        <th scope="col">Kabupaten</th>
                        <th scope="col">User</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($adminKabupatens as $key => $adminKabupaten)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $adminKabupaten->nama }}</td>
                            <td>{{ $adminKabupaten->nomor_hp }}</td>
                            <td>{{ $adminKabupaten->kabupaten_id }}</td>
                            <td>{{ $adminKabupaten->user_id }}</td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('admin-kabupaten-edit', [$adminKabupaten->slug]) }}"
                                        class="btn btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin-kabupaten-destroy', [$adminKabupaten->slug]) }}"
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
                {{ $adminKabupatens->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
