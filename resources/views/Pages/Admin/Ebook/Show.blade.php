@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header">
        <div class="section-header-back">
            <a href="/ebook" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ $title }}</h1>
    </div>
    <div class="section-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" scope="col">No.</th>
                    <th class="text-center" scope="col">Jenis Data</th>
                    <th class="text-center" scope="col">Isi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="text-center" scope="row">1</th>
                    <td class="text-center">Judul</td>
                    <td>{{ $ebook->judul }}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">2</th>
                    <td class="text-center">Stok</td>
                    <td>{{ $ebook->stok }}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">3</th>
                    <td class="text-center">Sinopsis</td>
                    <td>{!! $ebook->sinopsis !!}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">4</th>
                    <td class="text-center">Penerbit</td>
                    <td>{{ $ebook->penerbit }}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">5</th>
                    <td class="text-center">Pengarang</td>
                    <td>{{ $ebook->pengarang }}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">6</th>
                    <td class="text-center">Jumlah Halaman</td>
                    <td>{{ $ebook->halaman }}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">7</th>
                    <td class="text-center">Cover E-Book</td>
                    <td>
                        <img style="width: 9rem;" class="p-3 img-fluid rounded"
                            src="{{ asset('storage/' . $ebook->cover) }}" alt="{{ $ebook->judul }}">
                    </td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">8</th>
                    <td class="text-center">Tahun Rilis</td>
                    <td>{{ $ebook->tahunRilis }}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">9</th>
                    <td class="text-center">Keterangan</td>
                    <td>{{ $ebook->keterangan }}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">10</th>
                    <td class="text-center">Kategori E-Book</td>
                    <td>
                        @foreach ($ebook->kategoris as $kategori)
                            <span class="badge rounded-pill text-white bg-primary">{{ $kategori->nama }}</span>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
