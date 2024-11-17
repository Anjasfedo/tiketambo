@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Daftar Semua Acara</h1>
    </div>

    <div class="section-body">
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($acaras as $acara)
                                        <tr>
                                            <td>{{ $acara->nama }}</td>
                                            <td>{{ $acara->lokasi }}</td>
                                            <td>{{ $acara->tanggal }}</td>
                                            <td>
                                                <a href="{{ route('admin.acaras.tikets', $acara->id) }}" class="btn btn-primary btn-sm">
                                                    Penjualan Tiket
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
