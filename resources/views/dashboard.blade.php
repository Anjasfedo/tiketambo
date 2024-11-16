@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">Dashboard</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tabel Riwayat Pembelian Tiket</h4>
                            <div class="card-header-form">
                                <div class="input-group-btn">
                                    {{-- <a href="{% url 'incoming_disposition_export' %}" class="btn btn-primary"><i
                                            class="far fa-file-excel mx-1"></i><span>Export excel</span></a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="p-1 text-center">Tiket</th>
                                            <th class="p-1 text-center">Acara</th>
                                            <th class="p-1 text-center">Nominal</th>
                                            <th class="p-1 text-center">Total Tiket</th>
                                            <th class="p-1 text-center">Tanggal Pemesanan</th>
                                            <th class="p-1 text-center">Status</th>
                                        </tr>
                                        @php
                                            $penjualans = \App\Models\Penjualan::where('user_id', Auth::user()->id)->get();
                                        @endphp
                                        @foreach ($penjualans as $penjualan)
                                            <tr>
                                                <td class="text-center">
                                                  {{ $penjualan->tiket->nama }} {{ $penjualan->id }}
                                                </td>
                                                <td class="text-center">
                                                  {{ $penjualan->tiket->acara->nama }}
                                                </td>
                                                <td class="text-center">
                                                  {{ $penjualan->pembayaran->jumlah_bayar }}
                                                </td>
                                                <td class="text-center">
                                                  {{ $penjualan->pembayaran->jumlah_tiket }}
                                                </td>
                                                <td class="text-center">
                                                  {{ $penjualan->tanggal_pemesanan }}
                                                </td>
                                                <td class="text-center">
                                                  {{ $penjualan->status }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
