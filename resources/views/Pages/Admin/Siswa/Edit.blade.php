@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header">
        <div class="section-header-back">
            <a href="/siswa" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>{{ $title }}</h1>
    </div>

    <div class="section-body">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card">
                    <form action="/siswa/{{ $user->id }}" method="POST">
                        @method('patch')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Siswa</label>
                                <input type="name" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror" required
                                    value="{{ old('name', $user->name) }}" autofocus placeholder="Nama Siswa...">
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
                                    value="{{ old('username', $user->username) }}" placeholder="Username...">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="control-label">Status Akun</div>
                                <label for="is_suspended" class="custom-switch mt-2">
                                    <input @if ($user->is_suspended == 1) checked @endif type="checkbox"
                                        name="is_suspended" id="is_suspended" class="custom-switch-input" />
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Jika Menyala, Maka Akun di Suspend</span>
                                </label>
                            </div>
                            <div class="form-group mb-0">
                                <label for="kelas_id">Kelas</label>
                                <select name="kelas_id" id="kelas_id" class="form-control selectric" required>
                                    <option selected hidden disabled>Pilih Kelas...</option>
                                    @foreach ($kelas as $kelas)
                                        @if (old('kelas_id') == $kelas->id || $user->kelas_id == $kelas->id)
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
                            <button type="submit" class="btn btn-outline-warning">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
