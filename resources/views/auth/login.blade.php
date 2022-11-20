<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 rounded border border-light py-5 px-5"
                style="box-shadow:
            3.6px 3.1px 6.4px rgba(0, 0, 0, 0.014),
            8.6px 7.5px 15.3px rgba(0, 0, 0, 0.02),
            16.3px 14.1px 28.8px rgba(0, 0, 0, 0.025),
            29px 25.2px 51.4px rgba(0, 0, 0, 0.03),
            54.3px 47.2px 96.1px rgba(0, 0, 0, 0.036),
            130px 113px 230px rgba(0, 0, 0, 0.05);">
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
                <h1>Login</h1>
                <p>Gunakan Akun Universitas Anda</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                            id="email" aria-describedby="emailHelp">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <p>Bukan komputer Anda? Gunakan mode Tamu untuk login secara pribadi. Pelajari lebih lanjut
                    </p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('register') }}" class="link-primary text-decoration-none">Buat akun</a>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
