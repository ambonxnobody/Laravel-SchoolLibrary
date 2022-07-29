@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header d-flex justify-content-between">
        <h1>{{ $title }}</h1>
        <a href="/guru/create" class="btn btn-icon btn-outline-success"><i class="fas fa-plus"></i></a>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable-3">
                                <thead>
                                    <tr>
                                        <th class="text-center">Foto</th>
                                        <th class="text-center">Nama Guru</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Status Akun</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gurus as $guru)
                                        <tr>
                                            <td class="text-center">
                                                <img alt="{{ $guru->name }}"
                                                    src="@if ($guru->photo == null) https://ui-avatars.com/api/?color=00923F&background=E0FCE4&name={{ $guru->name }} @else {{ asset('storage/' . $guru->photo) }} @endif"
                                                    class="rounded-circle" width="35" data-toggle="tooltip"
                                                    title="{{ $guru->name }}">
                                            </td>
                                            <td>{{ $guru->name }}</td>
                                            <td>
                                                @if ($guru->kelas_id != null)
                                                    Wali Kelas {{ $guru->kelas->nama }}
                                                @else
                                                    Guru
                                                @endif
                                            </td>
                                            <td class="text-center"><span
                                                    class="badge rounded-pill badge-{{ $guru->is_suspended ? 'danger' : 'success' }}">{{ $guru->is_suspended ? 'Suspended' : 'Active' }}</span>
                                            </td>
                                            <td class="text-right d-flex justify-content-end">
                                                <a href="/guru/{{ $guru->id }}/edit"
                                                    class="btn btn-icon btn-outline-warning mr-1"><i
                                                        class="far fa-edit"></i></a>
                                                <form action="/guru/{{ $guru->id }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button
                                                        onclick="return confirm('Anda Yakin akan Menghapus Data Guru {{ $guru->name }}?')"
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
