@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header">
        <div class="section-header-back">
            <a href="/peminjaman" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ $title }}</h1>
    </div>

    <div class="section-body">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <form method="POST" action="/pengembalian">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">
                            <div class="form-group">
                                <label for="jumlah">Jumlah Pengembalian</label>
                                <input id="jumlah" name="jumlah" type="number"
                                    class="form-control @error('jumlah') is-invalid @enderror"
                                    value="{{ old('jumlah', $peminjaman->arsip) }}" max="{{ $peminjaman->arsip }}"
                                    placeholder="Jumlah Pengembalian">
                                @error('jumlah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="keterangan">Keterangan</label>
                                <input id="keterangan" name="keterangan" type="text"
                                    class="form-control @error('keterangan') is-invalid @enderror"
                                    value="{{ old('keterangan') }}" placeholder="Keterangan">
                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-outline-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
