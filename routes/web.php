<?php

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\User;
use App\Models\Ebook;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Dashboard', [
        'title' => 'Dashboard',
        'bukus' => Buku::query()->limit(10)->latest()->get(),
        'ebooks' => Ebook::latest()->get(),
    ]);
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
    Route::post('/login', [App\Http\Controllers\LoginController::class, 'authenticate']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/search', [App\Http\Controllers\SearchController::class, 'index']);

    Route::resource('/profil', App\Http\Controllers\ProfileController::class)->only(['edit', 'update', 'destroy']);

    Route::get('/myPeminjaman/{peminjaman}', function (User $peminjaman) {
        if (auth()->user()->id != $peminjaman->id) {
            abort(403);
        }
        return view('Pages.Auth.Peminjaman-Ku.Index', [
            'title' => 'Keranjang Peminjaman',
            'peminjamen' => Peminjaman::query()->where('user_id', $peminjaman->id)->where('status', '!=', 'Dikembalikan')->get(),
        ]);
    });

    Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout']);

    // Route::post('/meminjam', function (Request $request) {
    //     $validatedData = $request->validate([
    //         'user_id' => 'required|numeric',
    //         'jumlah' => 'required|numeric',
    //         'keterangan' => 'max:1000',
    //     ]);

    //     if ($request['satuanTanggal'] == 'hari') {
    //         $validatedData['tanggal'] = Carbon::now()->addDays($request['tanggal']);
    //     } elseif ($request['satuanTanggal'] == 'minggu') {
    //         $validatedData['tanggal'] = Carbon::now()->addWeeks($request['tanggal']);
    //     } elseif ($request['satuanTanggal'] == 'bulan') {
    //         $validatedData['tanggal'] = Carbon::now()->addMonths($request['tanggal']);
    //     }

    //     $validatedData['arsip'] = $validatedData['jumlah'];
    //     $validatedData['status'] = 'Dipinjam';

    //     $buku_id = $request['buku_id'];

    //     foreach ($buku_id as $buku) {
    //         $validatedData['buku_id'] = $buku;
    //         Peminjaman::query()->create($validatedData);
    //     }

    //     Alert::toast('Data Peminjaman Berhasil Ditambahkan!', 'success');
    //     return redirect('/peminjaman');
    // });
});

Route::group(['middleware' => 'wali-kelas'], function () {
    Route::get('/wali-kelas/{kelas}', function ($kelas) {
        if (auth()->user()->kelas_id != $kelas || auth()->user()->kelas_id == NULL) {
            abort(403);
        }
        return view('Pages.Wali-Kelas.Index', [
            'title' => 'Wali Kelas',
            'siswas' => User::query()->where('kelas_id', $kelas)->where('role', 'siswa')->get(),
        ]);
    });

    Route::get('/wali-kelas', function () {
        if (auth()->user()->kelas_id == NULL) {
            abort(403);
        }
    });
});

Route::group(['middleware' => 'admin'], function () {
    Route::resource('/kelas', App\Http\Controllers\KelasController::class)->except('show');
    Route::resource('/kategori', App\Http\Controllers\KategoriController::class)->except('show');

    Route::resource('/peminjaman', App\Http\Controllers\PeminjamanController::class)->except(['show', 'edit', 'update']);
    Route::get('/exportPeminjaman', [App\Http\Controllers\PeminjamanController::class, 'export']);
    Route::get('/peminjaman/filterBulan', [App\Http\Controllers\PeminjamanController::class, 'filterBulan']);

    Route::get('/pengembalian/create/{peminjaman}', [App\Http\Controllers\PeminjamanController::class, 'createPengembalian']);
    Route::post('/pengembalian', [App\Http\Controllers\PeminjamanController::class, 'storePengembalian']);

    Route::resource('/pengembalian', App\Http\Controllers\PengembalianController::class)->only(['index']);

    Route::resource('/buku', App\Http\Controllers\BukuController::class);
    Route::delete('/buku/{buku}/kategori/{kategori}', [App\Http\Controllers\BukuController::class, 'destroyKategori']);
    Route::post('/buku/kategori', [App\Http\Controllers\BukuController::class, 'storeKategori']);

    Route::resource('/ebook', App\Http\Controllers\EbookController::class);

    Route::resource('/guru', App\Http\Controllers\GuruController::class);

    Route::resource('/siswa', App\Http\Controllers\SiswaController::class)->except('show');
    Route::get('/siswa/filterKelas', [App\Http\Controllers\SiswaController::class, 'filterKelas']);
    Route::post('/siswa/gantiKelas', [App\Http\Controllers\SiswaController::class, 'gantiKelas']);
});
