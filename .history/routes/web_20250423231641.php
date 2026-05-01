<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\frontend\BeritaController;
use App\Http\Controllers\frontend\LaporanController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\frontend\StrukturController;
use App\Http\Controllers\frontend\VisiMisiController;
use App\Http\Controllers\backend\InputBeritaController;
use App\Http\Controllers\frontend\PengumumanController;
use App\Http\Controllers\backend\ChangePasswordController;
use App\Http\Controllers\backend\InputPengumumanController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\backend\KesehatanController;
use App\Http\Controllers\backend\BidangUmumController;
use App\Http\Controllers\backend\GotongRoyongController;

Route::get('/', [HomeController::class, 'index'], function () {
    return view('/home');
});

// untuk user (web)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// untuk pengguna (guard pengguna)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth:pengguna')
    ->name('dashboard');


// Route::get('/dashboard', [DashboardController::class, 'index'], function () {
//     return view('backend.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->middleware('auth:pengguna')      // <-- pakai guard 'pengguna'
//     ->name('pengguna.dashboard');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth', 'verified');

require __DIR__ . '/auth.php';

Route::resource('home', App\Http\Controllers\frontend\HomeController::class);
Route::resource('laporan', App\Http\Controllers\frontend\LaporanController::class);
Route::resource('berita', App\Http\Controllers\frontend\BeritaController::class);
Route::resource('pengumuman', App\Http\Controllers\frontend\PengumumanController::class);
Route::resource('pokja', App\Http\Controllers\frontend\PokjaController::class);
Route::resource('pokjathu', App\Http\Controllers\frontend\PokjathuController::class);
Route::resource('pokjatre', App\Http\Controllers\frontend\PokjatreController::class);
Route::resource('pokjafou', App\Http\Controllers\frontend\PokjafouController::class);
Route::resource('visimisi', App\Http\Controllers\frontend\VisiMisiController::class);
Route::resource('struktur', App\Http\Controllers\frontend\StrukturController::class);
Route::resource('mars', App\Http\Controllers\frontend\MarsController::class);
Route::resource('lambangpkk', App\Http\Controllers\frontend\LambangController::class);
Route::resource('sejarah', App\Http\Controllers\frontend\SejarahController::class);
Route::resource('showkes', App\Http\Controllers\frontend\TampilkesController::class);
Route::resource('showling', App\Http\Controllers\frontend\TampilkunganController::class);
Route::resource('showhat', App\Http\Controllers\frontend\TampilsehatController::class);
Route::resource('galery', App\Http\Controllers\frontend\GaleryController::class);
Route::get('frontend/show/{id}', [BeritaController::class, 'show'])->name('frontend.show');

Route::resource('input_berita', App\Http\Controllers\backend\InputBeritaController::class);
Route::resource('input_pengumuman', App\Http\Controllers\backend\InputPengumumanController::class);
Route::resource('profile', App\Http\Controllers\backend\ProfileController::class);
Route::resource('change_password', App\Http\Controllers\backend\ChangePasswordController::class);
Route::resource('jumlah_berita', App\Http\Controllers\backend\JumlahBeritaController::class);
Route::resource('galeri', App\Http\Controllers\backend\GaleriController::class);
Route::resource('kesehatan', App\Http\Controllers\backend\KesehatanController::class);
Route::get('/kesehatan/filter', [App\Http\Controllers\backend\KesehatanController::class, 'filter'])
    ->name('kesehatan.filter');
Route::get('/bidangumum/filter', [App\Http\Controllers\backend\BidangUmumController::class, 'filter'])
    ->name('bidangumum.filter');
Route::get('/gotongroyong/filter', [App\Http\Controllers\backend\GotongRoyongController::class, 'filter'])
    ->name('gotongroyong.filter');
Route::get('/pendidikan/filter', [App\Http\Controllers\backend\PendidikanController::class, 'filter'])
    ->name('pendidikan.filter');
Route::get('/pangan/filter', [App\Http\Controllers\backend\PanganController::class, 'filter'])
    ->name('pangan.filter');
Route::resource('kelestarian_lingkungan_hidup', App\Http\Controllers\backend\KelestarianLingkunganHidupController::class);
Route::resource('perencanaan_sehat', App\Http\Controllers\backend\PerencanaanSehatController::class);
Route::resource('input_berita', App\Http\Controllers\backend\InputBeritaController::class);
Route::resource('input_pengumuman', App\Http\Controllers\backend\InputPengumumanController::class);
Route::resource('profile', App\Http\Controllers\backend\ProfileController::class);
Route::resource('change_password', App\Http\Controllers\backend\ChangePasswordController::class);
Route::resource('galeripokja1', App\Http\Controllers\backend\Galeri1Controller::class);
Route::get('/galeripokja1/filter', [App\Http\Controllers\backend\Galeri1Controller::class, 'filter'])->name('galeripokja1.filter');
Route::get('/galeripokja2/filter', [App\Http\Controllers\backend\Galeri2Controller::class, 'filter'])->name('galeripokja2.filter');
Route::get('/galeripokja3/filter', [App\Http\Controllers\backend\Galeri3Controller::class, 'filter'])->name('galeripokja3.filter');
Route::get('/galeripokja4/filter', [App\Http\Controllers\backend\Galeri4Controller::class, 'filter'])->name('galeripokja4.filter');
Route::get('/galeribidangumum/filter', [App\Http\Controllers\backend\GaleriBidangUmumController::class, 'filter'])->name('galeribidangumum.filter');
Route::resource('galeripokja2', App\Http\Controllers\backend\Galeri2Controller::class);
Route::resource('galeripokja3', App\Http\Controllers\backend\Galeri3Controller::class);
Route::resource('galeripokja4', App\Http\Controllers\backend\Galeri4Controller::class);
Route::resource('pokja1', App\Http\Controllers\backend\Pokja1Controller::class);
Route::resource('pokja2', App\Http\Controllers\backend\Pokja2Controller::class);
Route::resource('pokja3', App\Http\Controllers\backend\Pokja3Controller::class);
Route::resource('pokja4', App\Http\Controllers\backend\Pokja4Controller::class);
Route::resource('laporanpokja1', App\Http\Controllers\backend\LaporanPokja1Controller::class);
Route::resource('laporanpokja3', App\Http\Controllers\backend\LaporanPokja3Controller::class);
Route::resource('laporanpokja4', App\Http\Controllers\backend\LaporanPokja4Controller::class);

Route::resource('deckesehatan', App\Http\Controllers\backend\DecKesehatanController::class);
Route::resource('deckelestarian', App\Http\Controllers\backend\DecKelestarianController::class);
Route::resource('decperencanaan', App\Http\Controllers\backend\DecPerencanaanController::class);
Route::resource('decpangan', App\Http\Controllers\backend\DecPanganController::class);
Route::resource('decpendidikan', App\Http\Controllers\backend\DecPendidikanController::class);
Route::resource('decpengembangan', App\Http\Controllers\backend\DecPengembanganController::class);
Route::resource('decpenghayatan', App\Http\Controllers\backend\DecPenghayatanController::class);
Route::resource('decperumahan', App\Http\Controllers\backend\DecPerumahanController::class);
Route::resource('decsandang', App\Http\Controllers\backend\DecSandangController::class);
Route::resource('decgotongroyong', App\Http\Controllers\backend\DecGotongRoyongController::class);
Route::resource('declaporanpokja1', App\Http\Controllers\backend\DecLaporanPokja1Controller::class);
Route::resource('declaporanpokja3', App\Http\Controllers\backend\DecLaporanPokja3Controller::class);
Route::resource('declaporanpokja4', App\Http\Controllers\backend\DecLaporanPokja4Controller::class);
Route::resource('decbidangumum', App\Http\Controllers\backend\DecBidangUmumController::class);

Route::resource('acckesehatan', App\Http\Controllers\backend\AccKesehatanController::class);
Route::resource('acckelestarian', App\Http\Controllers\backend\AccKelestarianController::class);
Route::resource('accperencanaan', App\Http\Controllers\backend\AccPerencanaanController::class);
Route::resource('accpangan', App\Http\Controllers\backend\AccPanganController::class);
Route::resource('accpendidikan', App\Http\Controllers\backend\AccPendidikanController::class);
Route::resource('accpengembangan', App\Http\Controllers\backend\AccPengembanganController::class);
Route::resource('accpenghayatan', App\Http\Controllers\backend\AccPenghayatanController::class);
Route::resource('accperumahan', App\Http\Controllers\backend\AccPerumahanController::class);
Route::resource('accsandang', App\Http\Controllers\backend\AccSandangController::class);
Route::resource('accgotongroyong', App\Http\Controllers\backend\AccGotongRoyongController::class);
Route::resource('acclaporanpokja1', App\Http\Controllers\backend\AccLaporanPokja1Controller::class);
Route::resource('acclaporanpokja3', App\Http\Controllers\backend\AccLaporanPokja3Controller::class);
Route::resource('acclaporanpokja4', App\Http\Controllers\backend\AccLaporanPokja4Controller::class);
Route::resource('accbidangumum', App\Http\Controllers\backend\AccBidangUmumController::class);

Route::resource('bidangumum', App\Http\Controllers\backend\BidangUmumController::class);
Route::resource('gotongroyong', App\Http\Controllers\backend\GotongRoyongController::class);
Route::resource('penghayatan', App\Http\Controllers\backend\PenghayatanController::class);
Route::resource('pendidikan', App\Http\Controllers\backend\PendidikanController::class);
Route::resource('pengembangan', App\Http\Controllers\backend\PengembanganController::class);
Route::resource('sandang', App\Http\Controllers\backend\SandangController::class);
Route::resource('pangan', App\Http\Controllers\backend\PanganController::class);
Route::resource('perumahan', App\Http\Controllers\backend\PerumahanController::class);

Route::resource('galeripenghayatan', App\Http\Controllers\backend\GaleriPenghayatanController::class);
Route::resource('galerigotongroyong', App\Http\Controllers\backend\GaleriGotongRoyongController::class);
Route::resource('galeripendidikan', App\Http\Controllers\backend\GaleriPendidikanController::class);
Route::resource('galeripengembangan', App\Http\Controllers\backend\GaleriPengembanganController::class);
Route::resource('galerisandang', App\Http\Controllers\backend\GaleriSandangController::class);
Route::resource('galeripangan', App\Http\Controllers\backend\GaleriPanganController::class);
Route::resource('galeriperumahan', App\Http\Controllers\backend\GaleriPerumahanController::class);
Route::resource('galerikesehatan', App\Http\Controllers\backend\GaleriKesehatanController::class);
Route::resource('galerikelestarian', App\Http\Controllers\backend\GaleriKelestarianController::class);
Route::resource('galeriperencanaan', App\Http\Controllers\backend\GaleriPerencanaanController::class);
Route::resource('galeribidangumum', App\Http\Controllers\backend\GaleriBidangUmumController::class);
Route::resource('galerilaporanpokja1', App\Http\Controllers\backend\GaleriLaporanPokja1Controller::class);
Route::resource('galerilaporanpokja3', App\Http\Controllers\backend\GaleriLaporanPokja3Controller::class);
Route::resource('galerilaporanpokja4', App\Http\Controllers\backend\GaleriLaporanPokja4Controller::class);

Route::resource('ttd', App\Http\Controllers\backend\TtdController::class);
Route::resource('ttdketua', App\Http\Controllers\backend\TtdKetuaController::class);
Route::resource('ttdwakilketua', App\Http\Controllers\backend\TtdWakilKetuaController::class);
