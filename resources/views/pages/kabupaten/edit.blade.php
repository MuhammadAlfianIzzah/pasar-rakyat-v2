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
            <h4 class="text-dark">Edit Data Negara {{ $kabupaten->nama }}</h4>
        </div>
        <div class="col-6">

        </div>
    </div>
    <div class="row mt-4 mb-2 bg-white py-4 px-4">
        <form class="col-12" action="{{ route('kabupaten-update', [$kabupaten->slug]) }}" method="POST"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" value="{{ old('nama') ?? ($kabupaten->nama ?? '') }}" name="nama"
                    class="form-control" id="nama">
                @error('nama')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="provinsi_id">Provinsi</label>
                <select class="custom-select" name="provinsi_id">
                    @foreach ($provinsis as $provinsi)
                        <option {{ $provinsi->id == $kabupaten->provinsi_id || old('provinsi_id') ? 'selected' : '' }}
                            value="{{ $provinsi->id }}">
                            {{ $provinsi->nama }}</option>
                    @endforeach
                </select>
                @error('provinsi_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('deskripsi') ?? ($kabupaten->deskripsi ?? '') }}</textarea>

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
            <div class="row">
                <div class="col">
                    <input type="text" value="{{ old('lat') ?? ($kabupaten->lat ?? '') }}" class="form-control"
                        placeholder="lat ..." name="lat">
                    @error('lat')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col">
                    <input type="text" value="{{ old('lang') ?? ($kabupaten->lang ?? '') }}" class="form-control"
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
