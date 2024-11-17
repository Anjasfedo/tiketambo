@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tikets for Acara: {{ $acara->nama }}</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <!-- Event Information Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Acara Details</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Lokasi:</strong> {{ $acara->lokasi }}</p>
                        <p><strong>Tanggal:</strong> {{ $acara->tanggal }}</p>
                    </div>
                </div>

                <!-- Ticket List Card -->
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Tiket</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Tiket</th>
                                        <th>Harga</th>
                                        <th>Stok Tersedia</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($acara->tiket as $tiket)
                                        <tr>
                                            <td>{{ $tiket->nama }}</td>
                                            <td>Rp {{ number_format($tiket->harga, 2) }}</td>
                                            <td>{{ $tiket->stok }}</td>
                                            <td>
                                                <a href="{{ route('admin.acaras.sales', $tiket->id) }}" class="btn btn-primary btn-sm">
                                                    Penjualan
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
