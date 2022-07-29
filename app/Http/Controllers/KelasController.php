<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Pages.Admin.Kelas.Index', [
            'title' => 'Data Kelas',
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
        return view('Pages.Admin.Kelas.Create', [
            'title' => 'Tambah Data Kelas',
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
            'nama' => 'required|unique:kelas|max:5',
            'keterangan' => 'nullable|max:1000',
        ]);

        Kelas::create($validatedData);
        Alert::toast('Data Kelas Berhasil Ditambahkan!', 'success');
        return redirect('/kelas');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kela)
    {
        return view('Pages.Admin.Kelas.Edit', [
            'title' => 'Ubah Data Kelas',
            'kelas' => $kela,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kela)
    {
        $validatedData = Validator::make($request->all(), [
            'nama' => [
                'required',
                'max:5',
                Rule::unique('kelas')->ignore($kela->id),
            ],
            'keterangan' => 'nullable|max:1000',
        ])->validate();

        Kelas::where('id', $kela->id)->update($validatedData);

        Alert::toast('Data Kelas Berhasil Diubah!', 'success');

        return redirect('/kelas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kela)
    {
        Kelas::destroy($kela->id);

        Alert::toast('Data Kelas Berhasil Dihapus!', 'success');

        return back();
    }
}
