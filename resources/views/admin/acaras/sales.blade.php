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
                        @if($penjualans->isEmpty())
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
                                        @foreach($penjualans as $penjualan)
                                            @php
                                                $totalHarga = $penjualan->pembayaran ? $penjualan->pembayaran->jumlah_bayar : $penjualan->tiket->harga * $penjualan->jumlah;
                                            @endphp
                                            <tr>
                                                <td>{{ $penjualan->nomor_pesanan }}</td>
                                                <td>{{ $penjualan->pembayaran->jumlah_tiket }}</td>
                                                <td>Rp {{ number_format($totalHarga, 2) }}</td>
                                                <td>{{ ucfirst($penjualan->status) }}</td>
                                                <td>
                                                    @if($penjualan->status === \App\Models\Penjualan::STATUS_COMPLETED)
                                                        <span class="badge badge-success">{{ \App\Models\Penjualan::STATUS_COMPLETED }}</span><br>
                                                        <small>{{ $penjualan->pembayaran->tanggal_pembayaran }}</small>
                                                    @elseif ($penjualan->status === \App\Models\Penjualan::STATUS_PENDING)
                                                        <span class="badge badge-warning">{{ \App\Models\Penjualan::STATUS_PENDING }}</span>
                                                        @else
                                                        <span class="badge badge-danger">{{ \App\Models\Penjualan::STATUS_CANCELED }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $penjualan->user->name }}</td>
                                                <td>{{ $penjualan->user->email }}</td>
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
