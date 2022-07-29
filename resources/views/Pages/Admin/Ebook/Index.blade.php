@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header d-flex justify-content-between">
        <h1>{{ $title }}</h1>
        <a href="/ebook/create" class="btn btn-icon btn-outline-success"><i class="fas fa-plus"></i></a>
    </div>
    <div class="section-body">
        @if ($ebooks->count() > 0)
            <div class="row">
                @foreach ($ebooks as $ebook)
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1 text-center"><a style="color: black;"
                                                href="/ebook/{{ $ebook->id }}">{{ $ebook->judul }}</a></h5>
                                        <p>{{ $ebook->excerpt }}</p>
                                    </div>
                                    <img height="75px" width="122px" src="{{ asset('storage/' . $ebook->cover) }}"
                                        alt="{{ $ebook->judul }}" class="ml-3 img-fluid rounded">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-outline-primary" href="/ebook/{{ $ebook->id }}">Baca
                                        Selengkapnya</a>
                                    <div>
                                        <a href="/ebook/{{ $ebook->id }}/edit"
                                            class="btn btn-icon btn-outline-warning mr-1"><i class="far fa-edit"></i></a>
                                        <form action="/ebook/{{ $ebook->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button
                                                onclick="return confirm('Anda Yakin akan Menghapus Data E-Book {{ $ebook->judul }}?')"
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
                <p>Tidak ada data e-book yang tersedia.</p>
            </div>
        @endif
    </div>
    <div class="d-flex justify-content-center align-items-end">
        {{ $ebooks->links() }}
    </div>
@endsection
