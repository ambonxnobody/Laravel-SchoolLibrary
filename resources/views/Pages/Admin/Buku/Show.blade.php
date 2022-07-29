@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header">
        <div class="section-header-back">
            <a href="/buku" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
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
                    <td>{{ $buku->judul }}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">2</th>
                    <td class="text-center">Stok</td>
                    <td>{{ $buku->stok }}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">3</th>
                    <td class="text-center">Sinopsis</td>
                    <td>{!! $buku->sinopsis !!}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">4</th>
                    <td class="text-center">Penerbit</td>
                    <td>{{ $buku->penerbit }}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">5</th>
                    <td class="text-center">Pengarang</td>
                    <td>{{ $buku->pengarang }}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">6</th>
                    <td class="text-center">Jumlah Halaman</td>
                    <td>{{ $buku->halaman }}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">7</th>
                    <td class="text-center">Cover Buku</td>
                    <td>
                        <img style="width: 9rem;" class="p-3 img-fluid rounded"
                            src="{{ asset('storage/' . $buku->cover) }}" alt="{{ $buku->judul }}">
                    </td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">8</th>
                    <td class="text-center">Tahun Rilis</td>
                    <td>{{ $buku->tahunRilis }}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">9</th>
                    <td class="text-center">Keterangan</td>
                    <td>{{ $buku->keterangan }}</td>
                </tr>
                <tr>
                    <th class="text-center" scope="row">10</th>
                    <td class="text-center">Kategori Buku</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex justify-content-start">
                                @foreach ($buku->kategoris as $kategori)
                                    <form action="/buku/{{ $buku->id }}/kategori/{{ $kategori->id }}"
                                        method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-icon icon-left mr-3"
                                            onclick="return confirm('Anda Yakin akan Melakukan Aksi Ini?')">
                                            <i class="fas fa-trash"></i> {{ $kategori->nama }}
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                            <form action="/buku/kategori" id="dbForm" method="POST">
                                @csrf
                                <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                <select onchange="autoSubmit()" name="kategori_id" class="form-control">
                                    <option hidden disabled selected>Tambah Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        function autoSubmit() {
            var formObject = document.forms['dbForm'];
            formObject.submit();
        }
    </script>
@endsection
