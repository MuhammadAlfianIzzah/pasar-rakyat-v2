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
            <h4 class="text-dark">Edit Data Admin Kabupaten {{ $adminKabupaten->nama }}</h4>
        </div>
        <div class="col-6">

        </div>
    </div>
    <div class="row mt-4 mb-2 bg-white py-4 px-4">
        <form class="col-12" action="{{ route('vendor-update', [$adminKabupaten->slug]) }}" method="POST"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" value="{{ old('nama') ?? ($adminKabupaten->nama ?? '') }}" name="nama"
                    class="form-control" id="nama">
                @error('nama')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="nomor_hp">Nomor Hp</label>
                <input type="text" value="{{ old('nomor_hp') ?? ($adminKabupaten->nomor_hp ?? '') }}" name="nomor_hp"
                    class="form-control" id="nomor_hp">
                @error('nomor_hp')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="provinsi_id">Kabupaten</label>
                <select class="custom-select" name="provinsi_id">
                    @foreach ($kabupatens as $kabupaten)
                        <option
                            {{ $kabupaten->id == $adminKabupaten->kabupaten_id || old('kabupaten_id') ? 'selected' : '' }}
                            value="{{ $kabupaten->id }}">
                            {{ $kabupaten->nama }}</option>
                    @endforeach
                </select>
                @error('provinsi_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="provinsi_id">User</label>
                <select class="custom-select" name="provinsi_id">
                    @foreach ($users as $user)
                        <option {{ $user->id == $adminKabupaten->user_id || old('user_id') ? 'selected' : '' }}
                            value="{{ $user->id }}">
                            {{ $user->name }}</option>
                    @endforeach
                </select>
                @error('provinsi_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
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
