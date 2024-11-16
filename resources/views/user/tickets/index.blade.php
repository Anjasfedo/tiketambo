@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tiket Saya</h1>
        </div>

        <div class="section-body">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tiket Aktif -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Tiket Aktif</h4>
                </div>
                <div class="card-body">
                    @if ($activeTickets->isEmpty())
                        <p class="text-muted">Tidak ada tiket aktif.</p>
                    @else
                        <div class="row">
                            @foreach ($activeTickets as $ticket)
                                <div class="border rounded p-3 mb-3 col-md-4">
                                    <p><strong>Nama Tiket:</strong> {{ $ticket->tiket->nama }}</p>
                                    <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>

                                    @php
                                        $latestPenjualanDetail = $ticket->penjualanDetails()->latest()->first();
                                    @endphp

                                    <p><strong>Harga:</strong>
                                        {{ $latestPenjualanDetail && $latestPenjualanDetail->adalah_resale
                                            ? number_format($ticket->harga_jual, 2)
                                            : number_format($ticket->tiket->harga, 2) }}
                                    </p>

                                    <form action="{{ route('user.tickets.resell', $ticket->id) }}" method="POST"
                                        class="mt-3">
                                        @csrf
                                        <div class="form-group">
                                            <label for="price">Atur Harga Jual Baru</label>
                                            <input type="number" name="price" id="price" class="form-control"
                                                max="{{ round($ticket->tiket->harga * 1.5, 2) }}"
                                                min="{{ round($ticket->tiket->harga * 0.9, 2) }}" step="0.01" required>
                                            <small class="form-text text-muted">
                                                Harga harus antara {{ number_format($ticket->tiket->harga * 0.9, 2) }} dan
                                                {{ number_format($ticket->tiket->harga * 1.5, 2) }}.
                                            </small>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-sm mt-2">
                                            Jual Tiket
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $activeTickets->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tiket Dijual -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Tiket Dijual</h4>
                </div>
                <div class="card-body">
                    @if ($forSaleTickets->isEmpty())
                        <p class="text-muted">Tidak ada tiket yang sedang dijual.</p>
                    @else
                        <div class="row">
                            @foreach ($forSaleTickets as $ticket)
                                <div class="border rounded p-3 mb-3 col-md-4">
                                    <p><strong>Nama Tiket:</strong> {{ $ticket->tiket->nama }}</p>
                                    <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
                                    <p><strong>Harga Jual:</strong> {{ number_format($ticket->harga_jual, 2) }}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $forSaleTickets->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tiket Terjual -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Tiket Terjual</h4>
                </div>
                <div class="card-body">
                    @if ($soldTickets->isEmpty())
                        <p class="text-muted">Belum ada tiket yang terjual.</p>
                    @else
                        <div class="row">
                            @foreach ($soldTickets as $ticket)
                                <div class="border rounded p-3 mb-3 col-md-4">
                                    <p><strong>Nama Tiket:</strong> {{ $ticket->tiket->nama }}</p>
                                    <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
                                    <p><strong>Harga Jual:</strong> {{ number_format($ticket->price, 2) }}</p>
                                    <form action="{{ route('user-ticket.activate', $ticket->id) }}" method="POST"
                                        class="mt-3">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            Aktifkan Ulang Tiket
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $soldTickets->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
