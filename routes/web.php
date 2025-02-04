<?php

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\ForgotPasswordController;

// Route::get('/', function () {
//     return view('auth/login');
// });


// Start Route Login & Register

Route::get('/registrasi', [AuthController::class, 'tampilRegistrasi'])->name('registrasi');
Route::post('/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('registrasi.submit');

Route::get('/', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/login/submit', [AuthController::class, 'submitLogin'])->name('login.submit');


Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])
    ->middleware('guest')
    ->name('password.update');
// end Route Login

// Start Route Content
Route::middleware('auth')->group(function (){
    Route::get('/siswa/index', [DataController::class, 'index'])->name('data');
    Route::get('/update/{id}', [DataController::class, 'edit'])->name('data.edit');
    Route::put('/update/{id}', [DataController::class, 'update'])->name('data.update');
    Route::delete('data/{id}', [DataController::class, 'destroy'])->name('data.delete');
    
    Route::get('/show/{id}', [DataController::class, 'detail'])->name('detail');
    
    Route::get('/post', [DataController::class, 'form'])->name('form');
    Route::post('/post', [DataController::class, 'store'])->name('form.post');
    
    
    Route::get('/phone/index', [PhoneController::class, 'index'])->name('phone');
    Route::post('/phone/{id}', [PhoneController::class, 'store'])->name('phone.post');
    Route::get('/phone/post{id}', [PhoneController::class, 'add'])->name('phone.add');
    Route::get('/phone/detail/{id}', [PhoneController::class, 'edit'])->name('phone.edit');
    Route::get('/phone/update/{id}', [PhoneController::class, 'edit2'])->name('phone.edit2');
    Route::put('/phone/update/{id}', [PhoneController::class, 'update'])->name('phone.update');
    Route::delete('/phone/show/{id}', [PhoneController::class, 'destroy'])->name('phone.delete');
    
    Route::get('/hobby/index', [HobbyController::class, 'index'])->name('hobby');
    Route::get('/addhobby/{id}/addhobby', [HobbyController::class, 'addhobby'])->name('tambah.hobby');
    Route::get('/hobby/detail', [HobbyController::class, 'detail'])->name('detail.hobby');
    Route::get('/hobby/show/{id}', [HobbyController::class, 'show'])->name('show.hobby');
    Route::get('hobby/detail/{id}', [HobbyController::class, 'editHobby'])->name('hobby.edit');
    Route::get('hobby/update/{id}', [HobbyController::class, 'editHobbySiswa'])->name('hobbysiswa.edit');
    Route::post('hobby/update/{id}', [HobbyController::class, 'updateHobbySiswa'])->name('update.hobbysiswa');
    Route::get('/hobby/add', [HobbyController::class, 'add'])->name('hobby.add');
    Route::post('/hobby/add', [HobbyController::class, 'storeHobby'])->name('hobby.post');
    Route::put('/hobby/detail', [HobbyController::class, 'updateHobby'])->name('hobby.update');
    Route::post('/addhobby/{id}', [HobbyController::class, 'storeaddhobby'])->name('add.hobby.post');
    Route::delete('/hobby/detail/{id}', [HobbyController::class, 'destroy'])->name('hobby.delete');

    Route::get('/blog/index', [BlogController::class, 'index'])->name('table.blog');
    Route::get('/blog/blog', [BlogController::class, 'blog'])->name('blog');
    Route::get('/blog/write', [BlogController::class, 'write'])->name('write');
    Route::post('/blog/write', [BlogController::class, 'store'])->name('blog.post');
    Route::get('/blog/show_blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::delete('/blog/index/{id}', [BlogController::class, 'destroy'])->name('blog.delete');
    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/edit/{id}', [BlogController::class, 'update'])->name('blog.update');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

});    

// End Route Content

Route::get('/send-welcome-mail', function (){
    $data = [
        'email' => 'contoh@gmail.com',
        'password' => 123
    ];
    Mail::to('aaa@gmail.com')->send(new WelcomeMail($data));
});




// Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);

// Route::get('/auth/google/callback',[SocialiteController::class, 'callback']);



Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');

