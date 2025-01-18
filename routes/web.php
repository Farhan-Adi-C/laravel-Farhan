<?php

use App\Models\Siswa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DataController::class, 'index'])->name('data');
Route::get('/form', [DataController::class, 'index2'])->name('form');
Route::get('/phone/{id}', [DataController::class, 'index3'])->name('phone');
Route::get('/detail/{id}', [DataController::class, 'index4'])->name('detail');


Route::get('/edit/{id}', [DataController::class, 'edit'])->name('data.edit');
Route::put('/edit/{id}', [DataController::class, 'update'])->name('data.update');
Route::delete('data/{id}', [DataController::class, 'destroy'])->name('data.delete');

Route::post('/form', [DataController::class, 'store'])->name('form.post');
Route::post('/phone/{id}', [DataController::class, 'store_phone'])->name('phone.post');


Route::get('/editphone/{id}', [DataController::class, 'edit2'])->name('phone.edit');
Route::put('/editphone/{id}', [DataController::class, 'update2'])->name('phone.update');
Route::delete('/detail/{id}', [DataController::class, 'destroy2'])->name('phone.delete');

Route::post('/detail/{id}', [DataController::class, 'store_hobby'])->name('hobby.post');

Route::get('/nyoba', function () {
    $siswa = Siswa::find(1);
    $hobby = ['1', '2', '3'];
    $siswa->hobby()->sync($hobby);
    echo 'berhasil';
    });

    Route::get('/hapus', function () {
    $siswa = Siswa::find(1);
    $siswa->hobby()->detach();
    echo 'berhasil menghapus';
    });