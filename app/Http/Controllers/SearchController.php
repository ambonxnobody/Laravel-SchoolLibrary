<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Ebook;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $bukus = Buku::query()->where('judul', 'like', '%' . request('search') . '%')->orWhere('sinopsis', 'like', '%' . request('search') . '%')->get();
            $ebooks = Ebook::query()->where('judul', 'like', '%' . request('search') . '%')->orWhere('sinopsis', 'like', '%' . request('search') . '%')->get();
            return view('Pages.Auth.Search.Index', [
                'title' => 'Hasil Pencarian',
                'bukus' => $bukus,
                'ebooks' => $ebooks,
            ]);
        } else {
            return redirect('/');
        }
    }
}
