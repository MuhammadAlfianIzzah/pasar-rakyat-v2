<x-admin-layout>
    <div class="container-fluid">
        <div class="alert alert-warning" role="alert">
            Riwayat Transaksi Belanja Anda
        </div>

        <div class="row bg-white px-4 mt-2">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#idtransaksi</th>
                            <th scope="col">nama</th>
                            <th scope="col">total</th>
                            <th scope="col">quantity</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksi as $tr)
                            <tr>
                                <th scope="row">{{ $tr->id }}</th>
                                <td>{{ $tr->nama }}</td>
                                <td>{{ $tr->total }}</td>
                                <td>{{ $tr->quantity }}</td>
                                <td>{{ $tr->created_at }}</td>
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
