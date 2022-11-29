<x-admin-layout>
    <div class="container-fluid">
        @if (auth()->user()->user_group_id != 1)
            <div class="row">
                <div class="col-12">
                    @if (auth()->user()->vendor->count() > 0)
                        <div class="alert alert-primary" role="alert">
                            Anda punya produk baru? segera
                            <a href="{{ route('market.index', [auth()->user()->vendor[0]->slug]) }}"
                                class="alert-link">Daftarkan segera</a>
                        </div>
                    @else
                        <div class="alert alert-primary" role="alert">
                            Anda memiliki produk yang ingin dipasarkan !! segera daftarkan produk anda diaplikasi kami
                            <a href="{{ route('daftar-vendor-index') }}" class="alert-link">Daftarkan segera</a>
                        </div>
                    @endif
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-dark">Data Transaksi anda</h5>
                        <img style="width: 100%;opacity: .1;border: 4px solid rgb(20, 9, 9)"
                            src="https://img.freepik.com/free-photo/businessman-black-suit-promoting-something_114579-15897.jpg?w=740&t=st=1669302852~exp=1669303452~hmac=164802d3c207ebf43bd795a404cd069a0ec5d5baccb517307438d5d952aa9859"
                            alt="img">
                        <p class="card-text">Lihat data yang belanja anda bulan ini</p>
                        <a href="{{ route('history.transaksi') }}" class="card-link">Lihat</a>
                        {{-- <a href="#" class="card-link">Export Data</a> --}}
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-dark">Data Management</h5>
                        <img style="width: 100%;opacity: .1;border: 4px solid rgb(20, 9, 9)"
                            src="https://img.freepik.com/free-photo/businessman-black-suit-promoting-something_114579-15897.jpg?w=740&t=st=1669302852~exp=1669303452~hmac=164802d3c207ebf43bd795a404cd069a0ec5d5baccb517307438d5d952aa9859"
                            alt="img">
                        <p class="card-text">Lihat data yang belanja anda bulan ini</p>
                        <a href="#" class="card-link  text-danger">Coming soon</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
