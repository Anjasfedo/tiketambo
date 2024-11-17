@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Penjualan Bulan {{ \Carbon\Carbon::parse($month . '-01')->translatedFormat('F Y') }}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Penjualan Tiket</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nomor Pesanan</th>
                                            <th>Nama Pembeli</th>
                                            <th>Nama Tiket</th>
                                            <th>Acara</th>
                                            <th>Jumlah Tiket</th>
                                            <th>Status</th>
                                            <th>Total Pembayaran</th>
                                            <th>Tanggal Pemesanan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($salesDetails as $sale)
                                            <tr>
                                                <td>{{ $sale->nomor_pesanan }}</td>
                                                <td>{{ $sale->buyer->name }}</td>
                                                <td>{{ $sale->tiket->nama }}</td>
                                                <td>{{ $sale->tiket->acara->nama }}</td>
                                                <td>{{ $sale->pembayaran->jumlah_tiket }}</td>
                                                <td>
                                                    @if ($sale->status === \App\Models\Penjualan::STATUS_COMPLETED)
                                                        <span
                                                            class="badge badge-success">{{ \App\Models\Penjualan::STATUS_COMPLETED }}</span><br>
                                                        <small>{{ $sale->pembayaran->tanggal_pembayaran }}</small>
                                                    @elseif ($sale->status === \App\Models\Penjualan::STATUS_PENDING)
                                                        <span
                                                            class="badge badge-warning">{{ \App\Models\Penjualan::STATUS_PENDING }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-danger">{{ \App\Models\Penjualan::STATUS_CANCELED }}</span>
                                                    @endif
                                                </td>
                                                <td>Rp{{ number_format($sale->pembayaran->jumlah_bayar, 2) }}</td>
                                                <td>{{ \Carbon\Carbon::parse($sale->tanggal_pemesanan)->format('Y-m-d') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada data penjualan untuk bulan
                                                    ini.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('admin.acaras.index') }}" class="btn btn-secondary mt-4">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
