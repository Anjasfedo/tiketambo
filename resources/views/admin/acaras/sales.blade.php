@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Penjualan untuk Tiket: {{ $ticket->nama }}</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <!-- Ticket Information Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Tiket Details</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Harga Tiket:</strong> Rp {{ number_format($ticket->harga, 2) }}</p>
                        <p><strong>Stok Tersedia:</strong> {{ $ticket->stok }}</p>
                    </div>
                </div>

                <!-- Sales List Card -->
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Penjualan</h4>
                    </div>
                    <div class="card-body">
                        @if($sales->isEmpty())
                            <p class="text-muted">Tidak ada penjualan untuk tiket ini.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nomor Pesanan</th>
                                            <th>Jumlah Tiket</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                            <th>Pembayaran</th>
                                            <th>Nama Pembeli</th>
                                            <th>Email Pembeli</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sales as $sale)
                                            @php
                                                $totalHarga = $sale->pembayaran ? $sale->pembayaran->jumlah_bayar : $sale->tiket->harga * $sale->jumlah;
                                            @endphp
                                            <tr>
                                                <td>{{ $sale->nomor_pesanan }}</td>
                                                <td>{{ $sale->pembayaran->jumlah_tiket }}</td>
                                                <td>Rp {{ number_format($totalHarga, 2) }}</td>
                                                <td>{{ ucfirst($sale->status) }}</td>
                                                <td>
                                                    @if($sale->status === 'completed')
                                                        <span class="badge badge-success">Completed</span><br>
                                                        <small>{{ $sale->pembayaran->tanggal_pembayaran }}</small>
                                                    @else
                                                        <span class="badge badge-warning">Pending</span>
                                                    @endif
                                                </td>
                                                <td>{{ $sale->user->name }}</td>
                                                <td>{{ $sale->user->email }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
