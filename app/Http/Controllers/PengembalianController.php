<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use RealRashid\SweetAlert\Facades\Alert;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Pages.Admin.Pengembalian.Index', [
            'title' => 'Data Pengembalian',
            'peminjamen' => Peminjaman::query()->where('status', 'Dikembalikan')->latest()->get(),
        ]);
    }
}
