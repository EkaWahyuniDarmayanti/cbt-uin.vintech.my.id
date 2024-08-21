<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Admin\AkunAdminController;
use App\Http\Controllers\Admin\AkunMentorController;
use App\Http\Controllers\Admin\AngkatanController;
use App\Http\Controllers\Admin\DataMahasiswaController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\KelompokController;
use App\Http\Controllers\Admin\KelompokMentorController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalMahasiswaController;
use App\Http\Controllers\JadwalMentorController;
use App\Http\Controllers\MentoringController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    // return redirect('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profil', [ProfileController::class, 'editProfile'])->name('profil.edit');
    Route::patch('/profil', [ProfileController::class, 'updateProfile'])->name('profil.update');

    Route::resource('mentoring', MentoringController::class);
    Route::get('mentoring/{id}/detail', [MentoringController::class, 'detail'])->name('mentoring.detail');
    Route::get('mentoring/{mentoring}/acc', [MentoringController::class, 'acc'])->name('mentoring.acc');
    Route::get('mentoring/{mentoring}/revisi', [MentoringController::class, 'revisi'])->name('mentoring.revisi');
    Route::patch('mentoring/{mentoring}/update-revisi', [MentoringController::class, 'updateRevisi'])->name('mentoring.update-revisi');
    Route::get('mentoring/{mentoring}/lihat-revisi', [MentoringController::class, 'lihatRevisi'])->name('mentoring.lihat-revisi');
    Route::get('mentoring-cetak', [MentoringController::class, 'cetak'])->name('mentoring.cetak');
    Route::get('mentoring-cetak-admin', [MentoringController::class, 'cetakAdmin'])->name('mentoring.cetak-admin');
    Route::get('mentoring-cetak-mahasiswa/{id}', [MentoringController::class, 'cetakMahasiswa'])->name('mentoring.cetak-mahasiswa');
    
    Route::resource('absensi', AbsensiController::class);
    Route::get('absensi/{id}/detail', [AbsensiController::class, 'detail'])->name('absensi.detail');
    Route::get('absensi/{absensi}/acc', [AbsensiController::class, 'acc'])->name('absensi.acc');

    Route::get('absensi-cetak-mahasiswa/{id}', [AbsensiController::class, 'cetakMahasiswa'])->name('absensi.cetak-mahasiswa');
    Route::get('absensi-cetak-admin', [AbsensiController::class, 'cetakAdmin'])->name('absensi.cetak-admin');

    Route::get('password', [PasswordController::class, 'edit'])->name('user.password.edit');
    Route::patch('password', [PasswordController::class, 'update'])->name('user.password.update');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function () {
    Route::resource('akun-admin', AkunAdminController::class);
    Route::resource('akun-mentor', AkunMentorController::class);
    Route::post('akun-mentor-import', [AkunMentorController::class, 'import'])->name('akun-mentor.import');
    Route::get('format-import-mentor', [AkunMentorController::class, 'formatImport']);
    Route::resource('data-mahasiswa', DataMahasiswaController::class);
    Route::post('data-mahasiswa-import', [DataMahasiswaController::class, 'import'])->name('data-mahasiswa.import');
    Route::get('format-import-mahasiswa', [DataMahasiswaController::class, 'formatImport']);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('angkatan', AngkatanController::class);
    Route::get('/kelompok/create/{angkatan}', [KelompokController::class, 'create'])->name('kelompok.create');
    Route::post('/kelompok', [KelompokController::class, 'store'])->name('kelompok.store');
    Route::get('/kelompok/{kelompok}', [KelompokController::class, 'show'])->name('kelompok.show');
    Route::delete('/kelompok/{kelompok}/{angkatan}', [KelompokController::class, 'destroy'])->name('kelompok.destroy');
    Route::get('/kelompok-mahasiswa/create/{kelompok}', [KelompokController::class, 'createKelompokMahasiswa'])->name('kelompok-mahasiswa.create');
    Route::post('/kelompok-mahasiswa', [KelompokController::class, 'storeKelompokMahasiswa'])->name('kelompok-mahasiswa.store');
    Route::delete('/kelompok-mahasiswa/{kelompokMahasiswa}/{kelompok}', [KelompokController::class, 'destroyKelompokMahasiswa'])->name('kelompok-mahasiswa.destroy');
    Route::get('kelompok-mentor', [KelompokMentorController::class, 'index'])->name('kelompok-mentor.index');
    Route::get('/kelompok-mentor/create/{kelompokMentor}', [KelompokMentorController::class, 'create'])->name('kelompok-mentor.create');
    Route::get('kelompok-mentor/{kelompokMentor}', [KelompokMentorController::class, 'show'])->name('kelompok-mentor.show');
    Route::post('/kelompok-mentor', [KelompokMentorController::class, 'store'])->name('kelompok-mentor.store');
    Route::delete('/kelompok-mentor/{kelompokMentor}/{kelompok}', [KelompokMentorController::class, 'destroy'])->name('kelompok-mentor.destroy');
});

Route::group(['prefix' => 'mentor', 'middleware' => ['auth', 'is_mentor']], function () {
    Route::get('lihat-kelompok', [KelompokMentorController::class, 'lihatKelompok'])->name('lihat-kelompok');
    Route::get('lihat-mahasiswa/{kelompok}', [KelompokMentorController::class, 'lihatMahasiswa'])->name('lihat-kelompok.mahasiswa');
    Route::get('lihat-jadwal', [JadwalMentorController::class, 'index'])->name('lihat-jadwal');
    Route::get('lihat-jadwal/{jadwalMentor}/keterangan', [JadwalMentorController::class, 'keterangan'])->name('lihat-jadwal.keterangan');
    Route::patch('lihat-jadwal/{jadwalMentor}/store-keterangan', [JadwalMentorController::class, 'storeKeterangan'])->name('lihat-jadwal.store-keterangan');
    Route::delete('lihat-jadwal/{jadwalMentor}/destroy', [JadwalMentorController::class, 'destroy'])->name('lihat-jadwal.destroy');
    Route::get('pilih-jadwal', [JadwalMentorController::class, 'create'])->name('pilih-jadwal');
    Route::post('/simpan-jadwal', [JadwalMentorController::class, 'store'])->name('simpan-jadwal');
});

Route::group(['prefix' => 'mahasiswa', 'middleware' => ['auth', 'is_mahasiswa']], function () {
    Route::get('detail-jadwal/{jadwal}/{user}/{jadwalMentor}', [JadwalMahasiswaController::class, 'index'])->name('detail.jadwal');
});
require __DIR__ . '/auth.php';
