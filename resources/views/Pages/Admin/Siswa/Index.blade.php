@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header d-flex justify-content-between">
        <h1>{{ $title }}</h1>
        <div class="d-flex justify-content-end">
            @if ($siswas->count() > 0)
                <form action="/siswa/filterKelas" id="dbForm" class="mr-3" method="get">
                    <select onchange="autoSubmit()" name="kelas" id="kelas" class="form-control">
                        <option hidden disabled selected>Pilih Kelas...</option>
                        @foreach ($siswas->groupBy('kelas_id') as $siswa)
                            <option value="{{ $siswa->first()->kelas_id }}">Kelas {{ $siswa->first()->kelas->nama }}
                            </option>
                        @endforeach
                    </select>
                </form>
            @endif
            <a href="/siswa/create" class="btn btn-icon btn-outline-success"><i class="fas fa-plus"></i></a>
        </div>
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
                                        <th class="text-center">Nama Siswa</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Status Akun</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $siswa)
                                        <tr>
                                            <td class="text-center">
                                                <img alt="{{ $siswa->name }}"
                                                    src="@if ($siswa->photo == null) https://ui-avatars.com/api/?color=00923F&background=E0FCE4&name={{ $siswa->name }} @else {{ asset('storage/' . $siswa->photo) }} @endif"
                                                    class="rounded-circle" width="35" data-toggle="tooltip"
                                                    title="{{ $siswa->name }}">
                                            </td>
                                            <td>{{ $siswa->name }}</td>
                                            <td>Kelas {{ $siswa->kelas->nama }}</td>
                                            <td class="text-center"><span
                                                    class="badge rounded-pill badge-{{ $siswa->is_suspended ? 'danger' : 'success' }}">{{ $siswa->is_suspended ? 'Suspended' : 'Active' }}</span>
                                            </td>
                                            <td class="text-right d-flex justify-content-end">
                                                <a href="/siswa/{{ $siswa->id }}/edit"
                                                    class="btn btn-icon btn-outline-warning mr-1"><i
                                                        class="far fa-edit"></i></a>
                                                <form action="/siswa/{{ $siswa->id }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button
                                                        onclick="return confirm('Anda Yakin akan Menghapus Data Siswa {{ $siswa->name }}?')"
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
    <script>
        function autoSubmit() {
            var formObject = document.forms['dbForm'];
            formObject.submit();
        }
    </script>
@endsection
