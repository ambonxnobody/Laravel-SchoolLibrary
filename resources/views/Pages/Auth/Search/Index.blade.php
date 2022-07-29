@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header">
        <div class="section-header-back d-inline">
            <a href="/" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ $title }}</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <h4>Buku</h4>
                @if ($bukus->count())
                    <div class="owl-carousel owl-theme slider" id="myCarousel">
                        @foreach ($bukus as $buku)
                            <a style="color: black; text-decoration: none;" href="/buku/{{ $buku->id }}">
                                <div class="card">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="flex-shrink-0">
                                            <img style="width: 9rem;" class="img-fluid rounded"
                                                src="{{ asset('storage/' . $buku->cover) }}" alt="{{ $buku->judul }}">
                                        </div>
                                        <div class="flex-grow-1 ml-3">
                                            <h5 class="align-items-start">{{ $buku->judul }}</h5>
                                            {{ $buku->excerpt }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="d-flex justify-content-center align-items-center mb-5 mt-5">
                        <p class="fs-4">Tidak ada data buku yang ditemukan.</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h4>E-Book</h4>
                @if ($ebooks->count())
                    <div class="owl-carousel owl-theme slider" id="myCarousel-2">
                        @foreach ($ebooks as $ebook)
                            <a style="color: black; text-decoration: none;" href="/ebook/{{ $ebook->id }}">
                                <div class="card">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="flex-shrink-0">
                                            <img style="width: 9rem;" class="img-fluid rounded"
                                                src="{{ asset('storage/' . $ebook->cover) }}" alt="{{ $ebook->judul }}">
                                        </div>
                                        <div class="flex-grow-1 ml-3">
                                            <h5 class="align-items-start">{{ $ebook->judul }}</h5>
                                            {{ $ebook->excerpt }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="d-flex justify-content-center align-items-center mb-5 mt-5">
                        <p class="fs-4">Tidak ada data e-book yang ditemukan.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
