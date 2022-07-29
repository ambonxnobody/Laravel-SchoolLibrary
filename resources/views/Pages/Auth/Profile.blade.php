@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header d-flex justify-content-between">
        <div class="d-flex">
            <div class="section-header-back">
                <a href="/" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>{{ $title }}</h1>
        </div>
        <form action="/profil/{{ $user->id }}" method="POST" class="d-inline">
            @method('delete')
            @csrf
            <button onclick="return confirm('Anda Yakin akan Melakukan Aksi Ini?')"
                class="btn btn-icon btn-outline-danger"><i class="fas fa-trash"></i> Hapus Akun</button>
        </form>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hai, {{ auth()->user()->name }}!</h2>
        <p class="section-lead">
            Ubah informasi tentang dirimu di halaman ini.
        </p>

        <div class="row mt-sm-4 d-flex justify-content-center">
            <div class="col-12 col-lg-7">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image"
                            src="@if ($user->photo == null) https://ui-avatars.com/api/?color=00923F&background=E0FCE4&name={{ auth()->user()->name }} @else {{ asset('storage/' . $user->photo) }} @endif"
                            class="rounded-circle profile-widget-picture">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Jumlah Peminjaman</div>
                                <div class="profile-widget-item-value">{{ $peminjamen->count() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-widget-description">
                        <form action="/profil/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="card-header">
                                <h4>Ubah Profil</h4>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="image-upload">Foto Profil</label>
                                    <input type="hidden" name="oldPhoto" value="{{ $user->photo }}">
                                    <div class="col-12">
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Pilih Foto</label>
                                            <input type="file" name="photo" id="image-upload" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="name">Nama Pengguna</label>
                                    <input id="name" name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="username">Username Pengguna</label>
                                    <input id="username" name="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror"
                                        value="{{ old('username', $user->username) }}" required>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-header">
                                <h4>Ubah Password</h4>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="password">Password Baru</label>
                                    <input name="password" id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror">
                                    @error('password_confirmation')
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
    </div>
@endsection
