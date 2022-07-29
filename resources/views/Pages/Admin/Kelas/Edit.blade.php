@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header">
        <div class="section-header-back">
            <a href="/kelas" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ $title }}</h1>
    </div>

    <div class="section-body">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <form action="/kelas/{{ $kelas->id }}" method="POST">
                        @method('patch')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama Kelas</label>
                                <input type="nama" id="nama" name="nama"
                                    class="form-control @error('nama') is-invalid @enderror" required=""
                                    value="{{ old('nama', $kelas->nama) }}" autofocus
                                    placeholder="Nama Kelas | Contoh : 1A...">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $kelas->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-outline-warning">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
