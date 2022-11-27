<x-admin-layout>

    <div class="row">
        <div class="col-6">
            <h4 class="text-dark">Edit {{ $vendor->nama }}</h4>
        </div>
        <div class="col-6">

        </div>
    </div>
    <div class="row mt-4 mb-2 bg-white py-4 px-4">
        <form class="col-12" action="{{ route('market.update', [$vendor->slug]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="pemilik">Pemilik</label>
                <input disabled type="text" value="{{ auth()->user()->name }}" name="pemilik" class="form-control"
                    id="pemilik">
                @error('pemilik')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama">Nama Toko</label>
                <input type="text" value="{{ old('nama') ?? $vendor->nama }}" name="nama" class="form-control"
                    id="nama">
                @error('nama')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('deskripsi') ?? $vendor->deskripsi }}</textarea>

                @error('deskripsi')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat_lengkap">Alamat Lengkap</label>
                <textarea name="alamat_lengkap" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('alamat_lengkap') ?? $vendor->alamat_lengkap }}</textarea>

                @error('alamat_lengkap')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="kabupaten_id">Kabupaten</label>
                <select class="custom-select" name="kabupaten_id">
                    @foreach ($kabupatens as $kabupaten)
                        <option {{ $kabupaten->id == old('kabupaten_id') ? 'selected' : '' }}
                            value="{{ $kabupaten->id }}">
                            {{ $kabupaten->nama }}</option>
                    @endforeach
                </select>
                @error('kabupaten_id')
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
                    <input type="text" value="{{ old('lat') ?? ($vendor->lat ?? '') }}" class="form-control"
                        placeholder="lat ..." name="lat">
                    @error('lat')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col">
                    <input type="text" value="{{ old('lang') ?? ($vendor->lang ?? '') }}" class="form-control"
                        placeholder="lang ..." name="lang">
                    @error('lang')
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
