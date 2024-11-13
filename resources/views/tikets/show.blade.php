@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Tiket untuk Acara: {{ $acara->nama }}</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $tiket->nama }}</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Nama Tiket:</strong> {{ $tiket->nama }}</p>
                        <p><strong>Harga Tiket:</strong> Rp {{ number_format($tiket->harga, 2) }}</p>
                        <p><strong>Stok Tiket:</strong> {{ $tiket->stok }}</p>

                        <a href="{{ route('acaras.show', $acara->id) }}" class="btn btn-secondary mt-4">
                            Kembali ke Acara
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
