@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Penarikan Dana</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ajukan Penarikan Dana</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Saldo Anda:</strong> {{ number_format(Auth::user()->saldo, 2) }}</p>

                        <form action="{{ route('withdrawal.request') }}" method="POST" class="mt-3">
                            @csrf
                            <div class="form-group">
                                <label for="amount">Withdrawal Amount</label>
                                <input type="number" name="amount" id="amount" class="form-control" min="1" max="{{ Auth::user()->saldo }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">
                                Ajukan Penarikan
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Riwayat</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdrawals as $withdrawal)
                                        <tr>
                                            <td>{{ $withdrawal->created_at->format('Y-m-d') }}</td>
                                            <td>${{ number_format($withdrawal->jumlah, 2) }}</td>
                                            <td>
                                                <span class="badge
                                                    @if ($withdrawal->status === \App\Models\Withdrawal::STATUS_PENDING) badge-warning
                                                    @elseif ($withdrawal->status === \App\Models\Withdrawal::STATUS_COMPLETED) badge-success
                                                    @else badge-danger @endif">
                                                    {{ ucfirst($withdrawal->status) }}
                                                </span>
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
