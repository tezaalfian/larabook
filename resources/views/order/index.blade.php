<x-layouts.admin :modal-delete="true">
    <x-slot:heading>
        <div class="page-pretitle">
            Order
        </div>
        <h2 class="page-title">
            Daftar Order
        </h2>
    </x-slot:heading>

    <x-slot:card-header>
        Daftar Order
    </x-slot:card-header>

    <div class="card-body">
        <form action="{{ route('order.index') }}" method="get">
            <div class="row">
                <div class="col-md-6">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pending" @selected(request()->status == 'pending')>Pending</option>
                        <option value="settlement" @selected(request()->status == 'settlement')>Settlement</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-filter">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" />
                        </svg>
                        Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pembeli</th>
                    <th>Transaksi</th>
                    <th>Nominal</th>
                    <th>Waktu Transaksi</th>
                    <th>Metode Pembayaran</th>
                    <th>Waktu Pembayaran</th>
                    <th>Link</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->buyer }}</td>
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
                        <td>
                            <a href="{{ $item->payment_url }}" target="_blank">Link</a>
                        </td>
                        <td><span class="badge">{{ $item->status }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer d-flex justify-content-end pb-0">
        {{ $orders->links() }}
    </div>
</x-layouts.admin>
