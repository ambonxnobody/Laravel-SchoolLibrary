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
                            <table class="table table-striped" id="myTable-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No.
                                        </th>
                                        <th class="text-center">Judul Buku</th>
                                        <th class="text-center">Nama Peminjam</th>
                                        <th class="text-center">Jumlah Dikembalikan</th>
                                        <th></th>
                                        <th class="text-center">Dikembalikan Pada</th>
                                        <th class="text-center">Keterangan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjamen as $peminjaman)
                                        @foreach ($peminjaman->pengembalians as $pengembalian)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>{{ $peminjaman->buku->judul }}</td>
                                                <td class="text-center">{{ $peminjaman->user->name }}</td>
                                                <td class="text-center">{{ $pengembalian->jumlah }}</td>
                                                <td></td>
                                                <td class="text-center">
                                                    {{ \Carbon\Carbon::parse($pengembalian->tanggal)->isoFormat('dddd, d MMMM Y') }}
                                                </td>
                                                <td>{{ $pengembalian->keterangan }}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
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
