@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header d-flex justify-content-between">
        <h1>{{ $title }}</h1>
        <a href="/buku/create" class="btn btn-icon btn-outline-success"><i class="fas fa-plus"></i></a>
    </div>
    <div class="section-body">
        @if ($bukus->count() > 0)
            <div class="row">
                @foreach ($bukus as $buku)
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1 text-center"><a style="color: black;"
                                                href="/buku/{{ $buku->id }}">{{ $buku->judul }}</a></h5>
                                        <p>{{ $buku->excerpt }}</p>
                                    </div>
                                    @if ($buku->cover)
                                        <img src="{{ asset('storage/' . $buku->cover) }}" alt="{{ $buku->judul }}"
                                            class="m-3 img-fluid rounded" height="75px" width="122px">
                                    @else
                                        <img src="{{ asset('assets/default.png') }}" alt="{{ $buku->judul }}"
                                            class="m-3 img-fluid rounded" height="75px" width="122px">
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-outline-primary" href="/buku/{{ $buku->id }}">Baca
                                        Selengkapnya</a>
                                    <div>
                                        <a href="/buku/{{ $buku->id }}/edit"
                                            class="btn btn-icon btn-outline-warning mr-1"><i class="far fa-edit"></i></a>
                                        <form action="/buku/{{ $buku->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button
                                                onclick="return confirm('Anda Yakin akan Menghapus Data Buku {{ $buku->judul }}?')"
                                                class="btn btn-icon btn-outline-danger"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-danger text-center">
                <h4 class="alert-heading">Tidak Ada Data</h4>
                <p>Tidak ada data buku yang tersedia.</p>
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-center align-items-end">
        {{ $bukus->links() }}
    </div>
@endsection
