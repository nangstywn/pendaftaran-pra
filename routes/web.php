<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\UserController;
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
});

Auth::routes();
Route::group(['prefix' => 'resource', 'as' => 'resource.'], function () {
    route::get('nim', [ResourceController::class, 'getNim'])->name('nim');
    route::get('pendaftaran', [ResourceController::class, 'getPendaftaran'])->name('pendaftaran');
    route::get('penguji', [ResourceController::class, 'getPenguji'])->name('penguji');
    route::get('pembimbing', [ResourceController::class, 'getPembimbing'])->name('pembimbing');
    route::get('acc-judul', [ResourceController::class, 'accJudul'])->name('acc-judul');
    route::delete('delete-judul/{id}', [ResourceController::class, 'deleteJudul'])->name('delete-judul');
});
Route::group(['prefix' => 'mahasiswa', 'as' => 'mahasiswa.', 'middleware' => 'auth'], function () {
    route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['prefix' => 'pendaftaran', 'as' => 'pendaftaran.'], function () {
        route::get('/', [PendaftaranController::class, 'index'])->name('index');
        route::get('/create', [PendaftaranController::class, 'create'])->name('create');
        route::get('{id_pendaftaran}/edit', [PendaftaranController::class, 'edit'])->name('edit');
        route::post('/store', [PendaftaranController::class, 'store'])->name('store');
        route::post('{id_pendaftaran}/update', [PendaftaranController::class, 'update'])->name('update');
    });
    Route::group(['prefix' => 'bimbingan', 'as' => 'bimbingan.'], function () {
        route::get('/', [BimbinganController::class, 'index'])->name('index');
        route::post('{id_pendaftaran}/store', [BimbinganController::class, 'store'])->name('store');
        route::get('{id_pendaftaran}/detail', [BimbinganController::class, 'detail'])->name('detail');

        // route::get('{id_pendaftaran}/edit', [PendaftaranController::class, 'edit'])->name('edit');
        // route::post('/store', [PendaftaranController::class, 'store'])->name('store');
        // route::post('{id_pendaftaran}/update', [PendaftaranController::class, 'update'])->name('update');
    });
    Route::group(['prefix' => 'ujian', 'as' => 'ujian.'], function () {
        route::get('/', [UjianController::class, 'indexMahasiswa'])->name('index');
        route::get('{id_ujian}/detail', [UjianController::class, 'detailMahasiswa'])->name('detail');
    });
});
Route::group(['prefix' => 'dosen', 'as' => 'dosen.', 'middleware' => 'auth:dosen'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'indexDosen']);

    Route::group(['prefix' => 'pembimbing', 'as' => 'pembimbing.', 'middleware' => ['auth:dosen', 'cekrole:dosen']], function () {
        Route::group(['prefix' => 'pra', 'as' => 'pra.'], function () {
            route::get('/', [PendaftaranController::class, 'index'])->name('index');
            route::get('/{nim}/detail', [PendaftaranController::class, 'detailDosen'])->name('detail');
            route::get('/{id_pendaftaran}/submit', [PendaftaranController::class, 'submit'])->name('submit');
        });

        Route::group(['prefix' => 'bimbingan', 'as' => 'bimbingan.'], function () {
            route::get('/', [BimbinganController::class, 'indexBimbinganDosen'])->name('index');
            route::get('/{id_pendaftaran}/detail', [BimbinganController::class, 'detailBimbinganDosen'])->name('detail');
            route::post('{id_pendaftaran}/store', [BimbinganController::class, 'storeDosen'])->name('store');
            route::post('/{id_pendaftaran}/acc', [BimbinganController::class, 'accBimbingan'])->name('acc');
        });
        Route::group(['prefix' => 'ujian', 'as' => 'ujian.'], function () {
            route::get('/', [UjianController::class, 'indexDosen'])->name('index');
            route::get('{id_ujian}/detail', [UjianController::class, 'detailDosen'])->name('detail');
        });
    });

    Route::group(['prefix' => 'prodi', 'as' => 'prodi.', 'middleware' => ['auth:dosen', 'prodi']], function () {
        route::get('/mahasiswa', [UserController::class, 'mahasiswa'])->name('mahasiswa');
        route::get('/dosen', [UserController::class, 'dosen'])->name('dosen');
        route::get('/create', [UserController::class, 'create'])->name('create');
        Route::group(['prefix' => 'bimbingan', 'as' => 'bimbingan.'], function () {
            route::get('/', [BimbinganController::class, 'indexBimbinganProdi'])->name('index');
            route::get('/{id_pendaftaran}/detail', [BimbinganController::class, 'detailBimbinganProdi'])->name('detail');
        });
        Route::group(['prefix' => 'ujian', 'as' => 'ujian.'], function () {
            route::get('/', [UjianController::class, 'indexProdi'])->name('index');
            route::get('{id_ujian}/detail', [UjianController::class, 'detailProdi'])->name('detail');
        });
    });

    Route::group(['prefix' => 'akademik', 'as' => 'akademik.', 'middleware' => ['auth:dosen', 'akademik']], function () {
        Route::group(['prefix' => 'bimbingan', 'as' => 'bimbingan.'], function () {
            route::get('/', [BimbinganController::class, 'indexBimbinganAkademik'])->name('index');
            route::get('/{id_pendaftaran}/detail', [BimbinganController::class, 'detailBimbinganAkademik'])->name('detail');
        });

        Route::group(['prefix' => 'ujian', 'as' => 'ujian.'], function () {
            route::get('/', [UjianController::class, 'index'])->name('index');
            route::get('/create', [UjianController::class, 'create'])->name('create');
            route::post('/store', [UjianController::class, 'store'])->name('store');
            route::post('{id_ujian}/selesai', [UjianController::class, 'selesai'])->name('selesai');
            route::get('{id_ujian}/detail', [UjianController::class, 'detail'])->name('detail');
        });
    });
});

route::get('logout', [LoginController::class, 'logout'])->name('logout');
route::get('{id}/profile', [UserController::class, 'profile'])->name('profile');
route::post('{id}/password', [UserController::class, 'password'])->name('password');