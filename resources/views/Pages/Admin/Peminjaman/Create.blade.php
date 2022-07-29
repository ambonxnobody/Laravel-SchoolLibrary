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
                    <form method="POST" action="/peminjaman">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="user_id">Peminjam</label>
                                <select name="user_id" id="user_id" class="form-control select2">
                                    <option disabled selected>Pilih Peminjam...</option>
                                    @foreach ($users as $user)
                                        @if (old('user_id') == $user->id)
                                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                        @else
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="buku_id[]">Judul Buku</label>
                                <select name="buku_id[]" id="buku_id[]" class="form-control select2" multiple="" required>
                                    @foreach ($bukus as $buku)
                                        @if (old('buku_id[]') == $buku->id)
                                            <option value="{{ $buku->id }}" selected>{{ $buku->judul }}</option>
                                        @else
                                            <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('buku_id[]')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah Peminjaman</label>
                                <input id="jumlah" name="jumlah" type="number"
                                    class="form-control @error('jumlah') is-invalid @enderror"
                                    value="{{ old('jumlah') }}" placeholder="Jumlah Peminjaman">
                                @error('jumlah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Lama Peminjaman</label>
                                <div class="input-group">
                                    <input name="tanggal" value="7" id="tanggal" type="number" class="form-control">
                                    <select name="satuanTanggal" class="custom-select" id="inputGroupSelect05">
                                        <option value="hari" selected>Hari</option>
                                        <option value="minggu">Minggu</option>
                                        <option value="bulan">Bulan</option>
                                    </select>
                                </div>
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
