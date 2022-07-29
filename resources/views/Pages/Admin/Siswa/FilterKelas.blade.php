@extends('Layouts.AppLayout')
@section('Pages')
    <div class="section-header d-flex justify-content-between">
        <div class="d-flex justify-content-start">
            <div class="section-header-back">
                <a href="/siswa" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>{{ $title . $kelas->first()->nama }}</h1>
        </div>
        <div class="d-flex justify-content-end">
            <form method="POST" action="/siswa/gantiKelas" class="d-flex">
                @method('POST')
                @csrf
                @foreach ($kelas as $kelaz)
                    @foreach ($kelaz->users->where('role', 'siswa') as $siswa)
                        <input type="hidden" name="siswa[]" value="{{ $siswa->id }}">
                    @endforeach
                @endforeach
                <button type="submit" class="btn btn-outline-warning">Ganti Semua Kelas Siswa</button>
                <select name="kelas_id" class="form-control ml-3 ">
                    @foreach ($allKelas as $gantiKelas)
                        @if ($kelas->first()->id == $gantiKelas->id)
                            <option value="{{ $gantiKelas->id }}" selected>Kelas {{ $gantiKelas->nama }}</option>
                        @else
                            <option value="{{ $gantiKelas->id }}">Kelas {{ $gantiKelas->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </form>
            <a href="/siswa/create" class="btn btn-icon btn-outline-success ml-3"><i class="fas fa-plus"></i></a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="myTable-4">
                                <thead>
                                    <tr>
                                        <th class="text-center">Foto</th>
                                        <th class="text-center">Nama Siswa</th>
                                        <th class="text-center">Kelas</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelas as $kelas)
                                        @foreach ($kelas->users->where('role', 'siswa')->sortBy('name') as $siswa)
                                            <tr>
                                                <td class="text-center">
                                                    <img alt="{{ $siswa->name }}"
                                                        src="@if ($siswa->photo == null) https://ui-avatars.com/api/?color=00923F&background=E0FCE4&name={{ $siswa->name }} @else {{ asset('storage/' . $siswa->photo) }} @endif"
                                                        class="rounded-circle" width="35" data-toggle="tooltip"
                                                        title="{{ $siswa->name }}">
                                                </td>
                                                <td>{{ $siswa->name }}</td>
                                                <td class="text-center"><span
                                                        class="badge rounded-pill badge-{{ $siswa->is_suspended ? 'danger' : 'success' }}">{{ $siswa->is_suspended ? 'Suspended' : 'Active' }}</span>
                                                </td>
                                                <td></td>
                                            </tr>
                                        @endforeach
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
