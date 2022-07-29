@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header d-flex justify-content-between">
        <h1>{{ $title }}</h1>
        <a href="/kategori/create" class="btn btn-icon btn-outline-success"><i class="fas fa-plus"></i></a>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No.
                                        </th>
                                        <th class="text-center">Nama Kategori</th>
                                        <th class="text-center">Keterangan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategoris as $kategori)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="text-center">{{ $kategori->nama }}</td>
                                            <td>{{ $kategori->keterangan }}</td>
                                            <td class="text-right">
                                                <a href="/kategori/{{ $kategori->id }}/edit"
                                                    class="btn btn-icon btn-outline-warning mr-1"><i
                                                        class="far fa-edit"></i></a>
                                                <form action="/kategori/{{ $kategori->id }}" method="POST"
                                                    class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button
                                                        onclick="return confirm('Anda Yakin akan Menghapus Data Kategori {{ $kategori->nama }}?')"
                                                        class="btn btn-icon btn-outline-danger"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
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
@endsection
