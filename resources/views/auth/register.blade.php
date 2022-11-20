<x-guest-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-7 rounded border border-light py-3 px-4">
                @if (Session::has('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hai!</strong> {{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Hai!</strong> {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h1>Register</h1>
                <p>Buat Akun Universitas Anda</p>
                <form method="POST" action="{{ route('register') }}">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" value="{{ old('name') ?? '' }}" name="name" class="form-control"
                            id="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" value="{{ old('email') ?? '' }}" name="email" class="form-control"
                            id="email" aria-describedby="emailHelp">

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" id="password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Re-Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="password_confirmation">
                                @error('password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <p>Bukan komputer Anda? Gunakan mode Tamu untuk login secara pribadi. Pelajari lebih lanjut
                    </p>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>

</x-guest-layout>
