@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tambah Tiket untuk: {{ $acara->nama }}</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Tiket</h4>
                    </div>
                    <div class="card-body">
                        <!-- Ticket Creation Form -->
                        <form action="{{ route('tikets.store', $acara->id) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="nama">Nama Tiket</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="harga">Harga Tiket</label>
                                <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga') }}" required>
                                @error('harga')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="stok">Stok Tiket</label>
                                <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok') }}" required>
                                @error('stok')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">
                                Tambah Tiket
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
