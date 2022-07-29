<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Exports\PeminjamanExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanController extends Controller
{
    public function filterBulan(Request $request)
    {
        $bulan = $request->month;
        Peminjaman::query()->where('tanggal', NULL)->update([
            'status' => 'Dikembalikan',
        ]);
        return view('Pages.Admin.Peminjaman.FilterBulan', [
            'title' => 'Peminjaman Bulan ' . \Carbon\Carbon::create()->month($bulan)->isoFormat('MMMM'),
            'peminjamen' => Peminjaman::whereMonth('tanggal', $bulan)->get(),
        ]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new PeminjamanExport, 'peminjaman.xlsx');
    }

    public function createPengembalian(Peminjaman $peminjaman)
    {
        return view('Pages.Admin.Peminjaman.CreatePengembalian', [
            'title' => 'Tambah Data Pengembalian',
            'peminjaman' => $peminjaman,
        ]);
    }

    public function storePengembalian(Request $request)
    {
        $validatedData = $request->validate([
            'peminjaman_id' => 'required',
            'jumlah' => 'required|numeric',
            'keterangan' => 'max:255',
        ]);

        $validatedData['tanggal'] = Carbon::now();

        Pengembalian::create($validatedData);

        Peminjaman::query()->where('id', $request->peminjaman_id)->update([
            'tanggal' => NULL,
        ]); // Is This Right?

        Alert::success('Data Pengembalian Berhasil Ditambahkan!');

        return redirect('/peminjaman');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Peminjaman::query()->where('tanggal', NULL)->update([
            'status' => 'Dikembalikan',
        ]);
        return view('Pages.Admin.Peminjaman.Index', [
            'title' => 'Data Peminjaman',
            'peminjamen' => Peminjaman::all()->sortBy('tanggal', SORT_NATURAL, false),
            'bulan' => Peminjaman::select(DB::raw("(DATE_FORMAT(created_at, '%m')) as month"))
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m')"))
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pages.Admin.Peminjaman.Create', [
            'title' => 'Tambah Data Peminjaman',
            'users' => User::query()->where('role', '=', 'siswa')->orWhere('role', '=', 'guru')->get(),
            'bukus' => Buku::all(),
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
            'user_id' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'keterangan' => 'max:1000',
        ]);

        if ($request['satuanTanggal'] == 'hari') {
            $validatedData['tanggal'] = Carbon::now()->addDays($request['tanggal']);
        } elseif ($request['satuanTanggal'] == 'minggu') {
            $validatedData['tanggal'] = Carbon::now()->addWeeks($request['tanggal']);
        } elseif ($request['satuanTanggal'] == 'bulan') {
            $validatedData['tanggal'] = Carbon::now()->addMonths($request['tanggal']);
        }

        $validatedData['arsip'] = $validatedData['jumlah'];
        $validatedData['status'] = 'Dipinjam';

        $buku_id = $request['buku_id'];

        foreach ($buku_id as $buku) {
            $validatedData['buku_id'] = $buku;
            Peminjaman::query()->create($validatedData);
        }

        Alert::toast('Data Peminjaman Berhasil Ditambahkan!', 'success');
        return redirect('/peminjaman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peminjaman $peminjaman)
    {
        Peminjaman::destroy($peminjaman->id);

        Alert::toast('Data Peminjaman Berhasil Dihapus!', 'success');

        return back();
    }
}
