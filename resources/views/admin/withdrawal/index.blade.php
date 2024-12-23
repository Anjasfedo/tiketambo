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
                            <h4>Data Pengajuan Penarikan Dana</h4>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('withdrawal.admin') }}" class="mb-4">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-md-3">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Cari berdasarkan nama atau nominal" value="{{ request('search') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <select name="status" class="form-control">
                                            <option value="">Pilih Status</option>
                                            <option value="{{ \App\Models\Withdrawal::STATUS_PENDING }}"
                                                {{ request('status') == \App\Models\Withdrawal::STATUS_PENDING ? 'selected' : '' }}>
                                                {{ \App\Models\Withdrawal::STATUS_PENDING }}
                                            </option>
                                            <option value="{{ \App\Models\Withdrawal::STATUS_COMPLETED }}"
                                                {{ request('status') == \App\Models\Withdrawal::STATUS_COMPLETED ? 'selected' : '' }}>
                                                {{ \App\Models\Withdrawal::STATUS_COMPLETED }}
                                            </option>
                                            <option value="{{ \App\Models\Withdrawal::STATUS_FAILED }}"
                                                {{ request('status') == \App\Models\Withdrawal::STATUS_FAILED ? 'selected' : '' }}>
                                                {{ \App\Models\Withdrawal::STATUS_FAILED }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                        <a href="{{ route('withdrawal.admin') }}" class="btn btn-secondary">Reset</a>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nominal</th>
                                            <th>Status</th>
                                            <th>Pengaju</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($withdrawals as $withdrawal)
                                            <tr>
                                                <td>{{ $withdrawal->created_at->format('Y-m-d') }}</td>
                                                <td>{{ number_format($withdrawal->jumlah, 2) }}</td>
                                                <td>
                                                    <span
                                                        class="badge
                                @if ($withdrawal->status === \App\Models\Withdrawal::STATUS_PENDING) badge-warning
                                @elseif ($withdrawal->status === \App\Models\Withdrawal::STATUS_COMPLETED) badge-success
                                @else badge-danger @endif">
                                                        {{ ucfirst($withdrawal->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $withdrawal->user->name }}</td>
                                                <td>
                                                    @if ($withdrawal->status === \App\Models\Withdrawal::STATUS_PENDING)
                                                        <div class="btn-group">
                                                            <form
                                                                action="{{ route('withdrawal.process', $withdrawal->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-success btn-sm">Terima</button>
                                                            </form>
                                                            <form
                                                                action="{{ route('withdrawal.cancel', $withdrawal->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Tolak</button>
                                                            </form>
                                                        </div>
                                                    @else
                                                        <span class="text-muted">Tidak ada aksi</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No withdrawals found.</td>
                                            </tr>
                                        @endforelse
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
