<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Pages.Admin.Guru.Index', [
            'title' => 'Data Guru',
            'gurus' => User::query()->where('role', 'guru')->orWhere('role', 'wali-kelas')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pages.Admin.Guru.Create', [
            'title' => 'Tambah Data Guru',
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
            'kelas_id' => 'nullable'
        ]);
        if ($request->kelas_id != '') {
            $validatedData['role'] = 'wali-kelas';
        } else {
            $validatedData['role'] = 'guru';
        }

        $validatedData['password'] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password

        $validatedData['remember_token'] = Str::random(20);

        User::create($validatedData);
        Alert::toast('Data Guru Berhasil Ditambahkan!', 'success');
        return redirect('/guru');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $guru)
    {
        if ($guru->role === 'guru' || $guru->role === 'wali-kelas') {
            return view('Pages.Admin.Guru.Edit', [
                'title' => 'Edit Data guru',
                'user' => $guru,
                'kelas' => Kelas::all(),
            ]);
        } else {
            Alert::toast('Data Guru Tidak Ditemukan!', 'error');
            return redirect('/guru');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $guru)
    {
        if ($guru->role === 'guru' || $guru->role === 'wali-kelas') {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'username' => 'required|max:255|unique:users,username,' . $guru->id,
                'kelas_id' => 'nullable'
            ]);

            if ($request->kelas_id != '') {
                $validatedData['role'] = 'wali-kelas';
            } else {
                $validatedData['role'] = 'guru';
            }

            if ($request->is_suspended) {
                $validatedData['is_suspended'] = true;
            } else {
                $validatedData['is_suspended'] = false;
            }

            User::query()->where('id', $guru->id)->update($validatedData);
            Alert::toast('Data Guru Berhasil Diubah!', 'success');
            return redirect('/guru');
        } else {
            Alert::toast('Data Guru Tidak Ditemukan!', 'error');
            return redirect('/guru');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $guru)
    {
        if ($guru->role === 'guru' || $guru->role === 'wali-kelas') {
            User::destroy($guru->id);

            Alert::toast('Data Guru Berhasil Dihapus!', 'success');

            return back();
        } else {
            Alert::toast('Data Guru Tidak Ditemukan!', 'error');
            return redirect('/guru');
        }
    }
}
