@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Penarikan Dana</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Data Penarikan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdrawals as $withdrawal)
                                        <tr>
                                            <td>{{ $withdrawal->created_at->format('Y-m-d') }}</td>
                                            <td>{{ number_format($withdrawal->jumlah, 2) }}</td>
                                            <td>
                                                <span class="badge
                                                    @if ($withdrawal->status === \App\Models\Withdrawal::STATUS_PENDING) badge-warning
                                                    @elseif ($withdrawal->status === \App\Models\Withdrawal::STATUS_COMPLETED) badge-success
                                                    @else badge-danger @endif">
                                                    {{ ucfirst($withdrawal->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($withdrawal->status === \App\Models\Withdrawal::STATUS_PENDING)
                                                    <div class="btn-group">
                                                        <form action="{{ route('withdrawal.process', $withdrawal->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm">
                                                                Terima
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('withdrawal.cancel', $withdrawal->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                Tolak
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <span class="text-muted">Tidak ada aksi</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $withdrawals->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
