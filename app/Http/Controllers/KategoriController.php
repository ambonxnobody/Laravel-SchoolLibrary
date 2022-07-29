<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Pages.Admin.Kategori.Index', [
            'title' => 'Data Kategori',
            'kategoris' => Kategori::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pages.Admin.Kategori.Create', [
            'title' => 'Tambah Data Kategori',
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
            'nama' => 'required|unique:kategoris|max:5',
            'keterangan' => 'nullable|max:1000',
        ]);

        Kategori::create($validatedData);
        Alert::toast('Data Kategori Berhasil Ditambahkan!', 'success');
        return redirect('/kategori');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        return view('Pages.Admin.Kategori.Edit', [
            'title' => 'Ubah Data Kategori',
            'kategori' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validatedData = Validator::make($request->all(), [
            'nama' => [
                'required',
                'max:255',
                Rule::unique('kategoris')->ignore($kategori->id),
            ],
            'keterangan' => 'nullable|max:1000',
        ])->validate();

        Kategori::where('id', $kategori->id)->update($validatedData);

        Alert::toast('Data Kategori Berhasil Diubah!', 'success');

        return redirect('/kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        Kategori::destroy($kategori->id);

        Alert::toast('Data Kategori Berhasil Dihapus!', 'success');

        return back();
    }
}
