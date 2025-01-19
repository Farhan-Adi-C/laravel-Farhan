<?php

use App\Http\Controllers\AuthController;
use App\Models\Siswa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/registrasi', [AuthController::class, 'tampilRegistrasi'])->name('registrasi');
Route::post('/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('registrasi.submit');

Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/login/submit', [AuthController::class, 'submitLogin'])->name('login.submit');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [DataController::class, 'index'])->name('data');

Route::middleware('auth')->group(function (){
    Route::get('/edit/{id}', [DataController::class, 'edit'])->name('data.edit');
    Route::put('/edit/{id}', [DataController::class, 'update'])->name('data.update');
    Route::delete('data/{id}', [DataController::class, 'destroy'])->name('data.delete');
    
    Route::get('/detail/{id}', [DataController::class, 'index4'])->name('detail');
    
    Route::get('/form', [DataController::class, 'index2'])->name('form');
    Route::post('/form', [DataController::class, 'store'])->name('form.post');
    
    
    Route::get('/phone/{id}', [DataController::class, 'index3'])->name('phone');
    Route::post('/phone/{id}', [DataController::class, 'store_phone'])->name('phone.post');
    Route::get('/editphone/{id}', [DataController::class, 'edit2'])->name('phone.edit');
    Route::put('/editphone/{id}', [DataController::class, 'update2'])->name('phone.update');
    Route::delete('/detail/{id}', [DataController::class, 'destroy2'])->name('phone.delete');
    
    Route::post('/detail/{id}', [DataController::class, 'store_hobby'])->name('hobby.post');
});    

