<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ebook;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Pages.Admin.Ebook.Index', [
            'title' => 'Data E-Book',
            'ebooks' => Ebook::latest()->paginate(6),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pages.Admin.Ebook.Create', [
            'title' => 'Tambah Data E-Book',
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
            'judul' => 'required|unique:ebooks|max:255',
            'cover' => 'image|file',
            'penerbit' => 'max:255',
            'pengarang' => 'max:255',
            'keterangan' => 'max:1000',
        ]);

        if ($request->file('cover')) {
            $validatedData['cover'] = $request->file('cover')->store('cover-ebook');
        }

        $validatedData['sinopsis'] = $request['sinopsis'];
        $validatedData['halaman'] = $request['halaman'];
        $validatedData['tahunRilis'] = $request['tahunRilis'];
        $validatedData['excerpt'] = Str::limit(strip_tags($request->sinopsis), 200);

        Ebook::create($validatedData);

        if ($request->kategori) {
            $kategoris = $request['kategori'];
            foreach ($kategoris as $kategori) {
                DB::table('kategori_ebook')->insert([
                    'ebook_id' => Ebook::latest()->first()->id,
                    'kategori_id' => $kategori,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        Alert::toast('Data E-Book Berhasil Ditambahkan!', 'success');

        return redirect('/ebook');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function show(Ebook $ebook)
    {
        return view('Pages.Admin.Ebook.Show', [
            'title' => 'Detail Data E-Book',
            'ebook' => $ebook,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Ebook $ebook)
    {
        return view('Pages.Admin.Ebook.Edit', [
            'title' => 'Ubah Data E-Book',
            'ebook' => $ebook,
            'kategoris' => Kategori::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ebook $ebook)
    {
        $validatedData = Validator::make($request->all(), [
            'judul' => [
                'required',
                'max:255',
                Rule::unique('ebooks')->ignore($ebook->id),
            ],
            'cover' => 'image|file',
            'penerbit' => 'max:255',
            'pengarang' => 'max:255',
            'keterangan' => 'max:1000',
        ])->validate();

        if ($request->file('cover')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['cover'] = $request->file('cover')->store('cover-ebook');
        }

        $validatedData['sinopsis'] = $request['sinopsis'];
        $validatedData['halaman'] = $request['halaman'];
        $validatedData['tahunRilis'] = $request['tahunRilis'];
        $validatedData['excerpt'] = Str::limit(strip_tags($request->sinopsis), 200);

        Ebook::where('id', $ebook->id)->update($validatedData);

        if ($request->kategori) {
            $kategoris = $request['kategori'];
            foreach ($kategoris as $kategori) {
                DB::table('kategori_ebook')->insert([
                    'ebook_id' => $ebook->id,
                    'kategori_id' => $kategori,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        Alert::toast('Data E-Book Berhasil Diubah!', 'success');

        return redirect('/ebook');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ebook $ebook)
    {
        if ($ebook->cover) {
            Storage::delete($ebook->cover);
        }

        Ebook::destroy($ebook->id);

        Alert::toast('Data E-Book Berhasil Dihapus!', 'success');

        return back();
    }
}
