<?php

use App\Http\Controllers\DisposisiSuratController;
use App\Http\Controllers\KodeSuratController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Models\Pegawai;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

// dgn adanya middleware kita harus melewati authentication dlu baru bisa akses tampilan lain
Route::middleware('auth')->group(function () {
    Route::get('/beranda', function () {
        $nama = Pegawai::where('id', auth()->user()->id)->get();
        $bulansuratmasuk = SuratMasuk::whereYear('tgl_sm', date('Y'))->whereMonth('tgl_sm', date('m'))->count();
        $bulansuratkeluar = SuratKeluar::whereYear('tgl_sk', date('Y'))->whereMonth('tgl_sk', date('m'))->count();
        $tahunsuratmasuk = SuratMasuk::whereYear('tgl_sm', date('Y'))->count();
        $tahunsuratkeluar = SuratKeluar::whereYear('tgl_sk', date('Y'))->count();
        return view('beranda', [
            'bulan_sm' => $bulansuratmasuk,
            'bulan_sk' => $bulansuratkeluar,
            'tahun_sm' => $tahunsuratmasuk,
            'tahun_sk' => $tahunsuratkeluar,
            'nama' => $nama[0]->nama,
        ])->with('active', 'beranda');
    })->name('beranda');

    Route::get('/suratmasuk', [SuratMasukController::class, 'index'])->name('suratmasuk');
    Route::post('/suratmasuk', [SuratMasukController::class, 'store'])->name('suratmasukstore');
    Route::put('/suratmasuk/{idsm}', [SuratMasukController::class, 'update'])->name('suratmasukupdate');
    Route::delete('/suratmasuk/{idsm}', [SuratMasukController::class, 'destroy'])->name('suratmasukdestroy');

    Route::get('/suratkeluar', [SuratKeluarController::class, 'index'])->name('suratkeluar');
    Route::post('/suratkeluar', [SuratKeluarController::class, 'store'])->name('suratkeluarstore');
    Route::put('/suratkeluar/{idsk}', [SuratKeluarController::class, 'update'])->name('suratkeluarupdate');
    Route::delete('/suratkeluar/{idsk}', [SuratKeluarController::class, 'destroy'])->name('suratkeluardestroy');

    Route::get('/disposisi/{idsm}', [DisposisiSuratController::class, 'index'])->name('disposisisurat');
    Route::post('/disposisi', [DisposisiSuratController::class, 'store'])->name('disposisisuratstore');
    Route::put('/disposisi/{idds}', [DisposisiSuratController::class, 'update'])->name('disposisisuratupdate');
    Route::delete('/disposisi/{idds}', [DisposisiSuratController::class, 'destroy'])->name('disposisisuratdestroy');

    Route::get('/kodesurat', [KodeSuratController::class, 'index'])->name('kodesurat');
    Route::post('/kodesurat', [KodeSuratController::class, 'store'])->name('kodesuratstore');
    Route::put('/kodesurat/{idkd}', [KodeSuratController::class, 'update'])->name('kodesuratupdate');
    Route::delete('/kodesurat/{idkd}', [KodeSuratController::class, 'destroy'])->name('kodesuratdestroy');
});
