@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header d-flex justify-content-between">
        <h1>{{ $title }}</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable-2">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No.
                                        </th>
                                        <th class="text-center">Judul Buku</th>
                                        <th class="text-center">Jumlah Dikembalikan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Dikembalikan Pada</th>
                                        <th class="text-center">Keterangan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjamen as $peminjaman)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{{ $peminjaman->buku->judul }}</td>
                                            <td class="text-center">{{ $peminjaman->jumlah }}</td>
                                            <td class="text-center">
                                                <span class="badge rounded-pill text-white {{ $peminjaman->status == 'Dipinjam' ? 'bg-warning' : ($peminjaman->status == 'Waktunya Dikembalikan' ? 'bg-danger' : 'bg-secondary') }}">{{ $peminjaman->status }}</span>
                                            </td>
                                            <td class="text-center">
                                                {{ $peminjaman->tanggal === null ? '' : \Carbon\Carbon::parse($peminjaman->tanggal)->diffForHumans() }}
                                            </td>
                                            <td>{{ $peminjaman->keterangan }}</td>
                                            <td class="text-right"></td>
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
@endsection
