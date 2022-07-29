<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    public function gantiKelas(Request $request)
    {
        foreach ($request->siswa as $siswa) {
            $kelas_id = $request->validate([
                'kelas_id' => 'required',
            ]);
            User::query()->where('id', ($siswa))->update($kelas_id);
        }
        Alert::toast('Kelas Siswa Berhasil Diubah!', 'success');
        return redirect('/siswa');
    }

    public function filterKelas(Request $request)
    {
        $kelas = $request->kelas;
        return view('Pages.Admin.Siswa.FilterKelas', [
            'title' => 'Data Siswa Kelas ',
            'kelas' => Kelas::query()->where('id', $kelas)->get(),
            'allKelas' => Kelas::all(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Pages.Admin.Siswa.Index', [
            'title' => 'Data Siswa',
            'siswas' => User::query()->where('role', 'siswa')->get(),
            'kelas' => Kelas::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pages.Admin.Siswa.Create', [
            'title' => 'Tambah Data Siswa',
            'kelas' => Kelas::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username',
            'kelas_id' => 'required'
        ]);

        $validatedData['role'] = 'siswa';
        $validatedData['password'] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $validatedData['remember_token'] = Str::random(20);

        User::create($validatedData);
        Alert::toast('Data Siswa Berhasil Ditambahkan!', 'success');
        return redirect('/siswa');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $siswa)
    {
        if ($siswa->role !== 'siswa') {
            Alert::toast('Data Siswa Tidak Ditemukan!', 'error');
            return redirect('/siswa');
        }
        return view('Pages.Admin.Siswa.Edit', [
            'title' => 'Edit Data Siswa',
            'user' => $siswa,
            'kelas' => Kelas::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $siswa)
    {
        if ($siswa->role !== 'siswa') {
            Alert::toast('Data Siswa Tidak Ditemukan!', 'error');
            return redirect('/siswa');
        }
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username,' . $siswa->id,
            'kelas_id' => 'required'
        ]);

        if ($request->is_suspended) {
            $validatedData['is_suspended'] = true;
        } else {
            $validatedData['is_suspended'] = false;
        }

        User::query()->where('id', $siswa->id)->update($validatedData);
        Alert::toast('Data Siswa Berhasil Diubah!', 'success');
        return redirect('/siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $siswa)
    {
        if ($siswa->role !== 'siswa') {
            Alert::toast('Data Siswa Tidak Ditemukan!', 'error');
            return redirect('/siswa');
        }
        User::destroy($siswa->id);

        Alert::toast('Data Siswa Berhasil Dihapus!', 'success');

        return back();
    }
}
