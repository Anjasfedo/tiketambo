@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Tiket untuk: {{ $acara->nama }}</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Edit Tiket</h4>
                    </div>
                    <div class="card-body">
                        <!-- Ticket Edit Form -->
                        <form action="{{ route('tikets.update', [$acara->id, $tiket->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nama">Nama Tiket</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $tiket->nama) }}" required>
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="harga">Harga Tiket</label>
                                <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga', $tiket->harga) }}" required>
                                @error('harga')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="stok">Stok Tiket</label>
                                <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok', $tiket->stok) }}" required>
                                @error('stok')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">
                                Update Tiket
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
