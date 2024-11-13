<!-- resources/views/acaras/index.blade.php -->
@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Acara</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" onclick="location.href='{{ route('acaras.create') }}'">Create Acara</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tabel Acara</h4>
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
                                            <th></th>
                                            <th class="p-1 text-center">Information</th>
                                            <th class="p-1 text-center">Note</th>
                                            <th class="p-1 text-center">Mail</th>
                                            <th class="p-1 text-center">User</th>
                                            <th class="p-1 text-center">Action</th>
                                        </tr>

                                        @foreach ($acaras as $acara)
                                            <tr>
                                                <td class="text-center">
                                                    @if ($acara->gambar)
                                                        <img src="{{ asset('storage/' . $acara->gambar) }}"
                                                            alt="Gambar Acara" class="w-16 h-16 object-cover rounded">
                                                    @else
                                                        <span class="text-gray-500">Tidak Ada Gambar</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                </td>
                                                <td class="text-align">{{ $acara->nama }}</td>
                                                <td class="text-center">{{ $acara->lokasi }}</td>
                                                <td class="text-center">{{ $acara->tanggal }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('acaras.show', $acara->id) }}"
                                                            class="btn btn-info mx-1">Update</a>
                                                        <form action="{{ route('acaras.destroy', $acara->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="submit" class="btn btn-danger mx-1"
                                                                value="Delete" />
                                                        </form>
                                                    </div>
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
        </div>
    </section>
@endsection
