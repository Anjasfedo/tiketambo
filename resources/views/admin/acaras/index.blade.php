@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Semua Acara</h1>
        </div>

        <div class="section-body">
            <!-- Filter Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Filter Acara dan Tiket</h4>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.acaras.index') }}" class="mb-4">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-md-2">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Cari nama atau lokasi acara" value="{{ request('search') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="ticket_search" class="form-control"
                                            placeholder="Cari nama atau harga tiket" value="{{ request('ticket_search') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <select name="tanggal" class="form-control">
                                            <option value="">Pilih Bulan Acara Diselenggarakan</option>
                                            @foreach ($months as $month)
                                                <option value="{{ $month }}"
                                                    {{ request('tanggal') == $month ? 'selected' : '' }}>
                                                    {{ \Carbon\Carbon::parse($month . '-01')->translatedFormat('F Y') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="{{ route('admin.acaras.index') }}" class="btn btn-secondary">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Events Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Penjualan Acara</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Acara</th>
                                            <th>Lokasi</th>
                                            <th>Tanggal</th>
                                            <th>Daftar Tiket</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($acaras as $acara)
                                            <tr>
                                                <td>{{ $acara->nama }}</td>
                                                <td>{{ $acara->lokasi }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($acara->tanggal . '-01')->translatedFormat('d F Y') }}
                                                </td>
                                                <td>
                                                    <ul>
                                                        @forelse($acara->tiket as $tiket)
                                                            <li>{{ $tiket->nama }}
                                                                (Rp{{ number_format($tiket->harga, 2) }})
                                                            </li>
                                                        @empty
                                                            <li>Tidak ada tiket</li>
                                                        @endforelse
                                                    </ul>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.acaras.tikets', $acara->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        Penjualan Tiket
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $acaras->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sales by Month Table -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Penjualan Tiket Berdasarkan Bulan</h4>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.acaras.index') }}" class="mb-4">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-md-2">
                                        <input type="date" name="start_date" class="form-control"
                                            placeholder="Tanggal Mulai"
                                            value="{{ request('start_date', $startDate ?? '') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="date" name="end_date" class="form-control"
                                            placeholder="Tanggal Akhir" value="{{ request('end_date', $endDate ?? '') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="{{ route('admin.acaras.index') }}" class="btn btn-secondary">Reset</a>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>Jumlah Penjualan</th>
                                            <th>Total Pendapatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($salesByMonth as $month => $data)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($month . '-01')->translatedFormat('F Y') }}</td>
                                                <td>{{ $data['total_sales'] }}</td>
                                                <td>Rp{{ number_format($data['total_revenue'], 2) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.acaras.sales.detail', $month) }}"
                                                        class="btn btn-info btn-sm">
                                                        Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data penjualan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $acaras->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
