@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header">
        <div class="section-header-back">
            <a href="/guru" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ $title }}</h1>
    </div>

    <div class="section-body">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <form action="/guru" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Guru</label>
                                <input type="name" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror" required
                                    value="{{ old('name') }}" autofocus placeholder="Nama Guru...">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="username" id="username" name="username"
                                    class="form-control @error('username') is-invalid @enderror" required
                                    value="{{ old('username') }}" placeholder="Username...">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <label for="kelas_id">Kelas</label>
                                <select name="kelas_id" id="kelas_id" class="form-control selectric">
                                    <option selected value="">Pilih Kelas Jika Wali Kelas...</option>
                                    @foreach ($kelas as $kelas)
                                        @if (old('kelas_id') == $kelas->id)
                                            <option value="{{ $kelas->id }}" selected>Kelas {{ $kelas->nama }}</option>
                                        @else
                                            <option value="{{ $kelas->id }}">Kelas {{ $kelas->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <p class="text-danger">{{ $message }}</p>
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
