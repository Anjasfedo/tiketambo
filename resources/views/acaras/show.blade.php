@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Acara Details</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $acara->nama }}</h4>
                        </div>
                        <div class="card-body">
                            @if ($acara->gambar)
                                <div class="mb-4">
                                    <img src="{{ asset('storage/' . $acara->gambar) }}" alt="Gambar Acara"
                                         class="img-thumbnail w-100" style="max-width: 250px;">
                                </div>
                            @endif

                            <p><strong>Lokasi:</strong> {{ $acara->lokasi }}</p>
                            <p><strong>Tanggal:</strong> {{ $acara->tanggal }}</p>
                            <p><strong>Jam:</strong> {{ $acara->jam }}</p>
                            <p><strong>Deskripsi:</strong> {{ $acara->deskripsi }}</p>

                            <a href="{{ route('acaras.index') }}" class="btn btn-secondary mt-4">
                                Kembali ke Daftar Acara
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket Management Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kelola Tiket</h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('tikets.create', $acara->id) }}" class="btn btn-success mb-3">
                                Tambah Tiket
                            </a>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Tiket</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($acara->tiket as $tiket)
                                            <tr>
                                                <td>{{ $tiket->nama }}</td>
                                                <td>{{ number_format($tiket->harga, 2) }}</td>
                                                <td>{{ $tiket->stok }}</td>
                                                <td>
                                                    <a href="{{ route('tikets.show', [$acara->id, $tiket->id]) }}" class="btn btn-info btn-sm">
                                                        Lihat
                                                    </a>
                                                    <a href="{{ route('tikets.edit', [$acara->id, $tiket->id]) }}" class="btn btn-warning btn-sm mx-1">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('tikets.destroy', [$acara->id, $tiket->id]) }}" method="POST" class="d-inline delete-alertbox">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                >Hapus</button>
                                                    </form>
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
