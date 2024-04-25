<x-layouts.client>
    <x-slot:heading>
        <div class="col">
            <div class="page-pretitle">
                Order
            </div>
            <h2 class="page-title">
                Daftar Order
            </h2>
        </div>
    </x-slot:heading>

    <div class="row g-4">
        <div class="card">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Transaksi</th>
                            <th>Nominal</th>
                            <th>Waktu Transaksi</th>
                            <th>Metode Pembayaran</th>
                            <th>Waktu Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->transaction }}</td>
                                <td>@currency($item->price)</td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $item->payment_method }}</td>
                                <td>
                                    @if ($item->payment_time)
                                        {{ $item->payment_time->format('d/m/Y H:i') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td><span class="badge">{{ $item->status }}</span></td>
                                <td>
                                    @if ($item->status == 'pending')
                                        <a href="{{ $item->payment_url }}" target="_blank"
                                            class="btn btn-primary btn-sm">Bayar</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end pb-0">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-layouts.client>
