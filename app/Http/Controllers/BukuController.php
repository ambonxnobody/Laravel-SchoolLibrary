<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function storeKategori(Request $request)
    {
        DB::insert('insert into kategori_buku (buku_id, kategori_id) values (?, ?)', [$request->buku_id, $request->kategori_id]);

        Alert::toast('Kategori Buku Berhasil Ditambahkan!', 'success');

        return back();
    }

    public function destroyKategori($kategori,  $buku)
    {
        // $kategori_id = (int)$kategori;
        // $buku_id = (int)$buku;
        DB::table('kategori_buku')->where('buku_id', $buku)->where('kategori_id', $kategori)->delete();

        Alert::toast('Kategori Buku Berhasil Dihapus!', 'success');

        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Pages.Admin.Buku.Index', [
            'title' => 'Data Buku',
            'bukus' => Buku::latest()->paginate(6),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pages.Admin.Buku.Create', [
            'title' => 'Tambah Data Buku',
            'kategoris' => Kategori::all(),
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
            'judul' => 'required|unique:bukus|max:255',
            'jumlah' => 'required|numeric',
            'cover' => 'image|file',
            'penerbit' => 'max:255',
            'pengarang' => 'max:255',
            'keterangan' => 'max:1000',
        ]);

        if ($request->file('cover')) {
            $validatedData['cover'] = $request->file('cover')->store('cover-buku');
        }

        $validatedData['sinopsis'] = $request['sinopsis'];
        $validatedData['halaman'] = $request['halaman'];
        $validatedData['tahunRilis'] = $request['tahunRilis'];
        $validatedData['excerpt'] = Str::limit(strip_tags($request->sinopsis), 200);

        $validatedData['stok'] = $request->jumlah;

        Buku::create($validatedData);

        if ($request->kategori) {
            $kategoris = $request['kategori'];
            foreach ($kategoris as $kategori) {
                DB::table('kategori_buku')->insert([
                    'buku_id' => Buku::latest()->first()->id,
                    'kategori_id' => $kategori,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        Alert::toast('Data Buku Berhasil Ditambahkan!', 'success');

        return redirect('/buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        return view('Pages.Admin.Buku.Show', [
            'title' => 'Detail Data Buku',
            'buku' => $buku,
            'kategoris' => Kategori::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        return view('Pages.Admin.Buku.Edit', [
            'title' => 'Ubah Data Buku',
            'buku' => $buku,
            'kategoris' => Kategori::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
    {
        $validatedData = Validator::make($request->all(), [
            'judul' => [
                'required',
                'max:255',
                Rule::unique('bukus')->ignore($buku->id),
            ],
            'jumlah' => 'max:4',
            'cover' => 'image|file',
            'penerbit' => 'max:255',
            'pengarang' => 'max:255',
            'keterangan' => 'max:1000',
        ])->validate();

        if ($request->file('cover')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['cover'] = $request->file('cover')->store('cover-buku');
        }

        $validatedData['sinopsis'] = $request['sinopsis'];
        $validatedData['halaman'] = $request['halaman'];
        $validatedData['tahunRilis'] = $request['tahunRilis'];
        $validatedData['excerpt'] = Str::limit(strip_tags($request->sinopsis), 200);

        $validatedData['jumlah'] = $buku->jumlah + $request->jumlah;
        $validatedData['stok'] = $buku->stok + $request->jumlah;

        Buku::where('id', $buku->id)->update($validatedData);

        if ($request->kategori) {
            $kategoris = $request['kategori'];
            foreach ($kategoris as $kategori) {
                DB::table('kategori_buku')->insert([
                    'buku_id' => $buku->id,
                    'kategori_id' => $kategori,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        Alert::toast('Data Buku Berhasil Diubah!', 'success');

        return redirect('/buku');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        if ($buku->cover) {
            Storage::delete($buku->cover);
        }

        Buku::destroy($buku->id);

        Alert::toast('Data Buku Berhasil Dihapus!', 'success');

        return back();
    }
}
