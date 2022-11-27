<x-admin-layout>
    <div class="container-fluid">
        <h3>Claim Transaksi</h3>
        <p>Transaksi yang sudah dibayar silahkan di claim disini yah</p>

        <form class="row bg-white py-3 px-4" action="{{ route('admin-claimTrasaksi') }}" method="POST">
            @csrf
            <div class="col-12">
                <div class="mb-3">
                    <label for="transaksi_total_id" class="form-label">Transaksi Code</label>
                    <input type="text" name="transaksi_total_id" class="form-control" id="transaksi_total_id">
                    @error('transaksi_total_id')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">
                        Claim Transaksi
                    </button>
                </div>
            </div>
        </form>
        <div class="row bg-white px-4 mt-2">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#idtransaksi</th>
                            <th scope="col">total</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksi as $tr)
                            <tr>
                                <th scope="row">{{ $tr->id }}</th>
                                <td>{{ $tr->nama }}</td>
                                <td>
                                    {!! $tr->already_paid
                                        ? '<span class="text-success">Di bayar pada ' . $tr->already_paid . '</span>'
                                        : 'belum dibayar' !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    <div class="alert alert-warning" role="alert">
                                        Data masih kosong
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
