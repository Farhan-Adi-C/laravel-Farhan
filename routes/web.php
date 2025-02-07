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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PermissionController;

// Route::get('/', function () {
//     return view('auth/login');
// // });
// Route::get('/change-role', function () {
//     return view('users.change-role');
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

// Super Admin Routes (user, role, etc.)
Route::middleware('auth')->group(function () {
    Route::middleware('role:super-admin')->group(function () {
        // User and Role Routes
        Route::get('/user', [PermissionController::class, 'index'])->name('user');
        Route::get('/role', [PermissionController::class, 'role'])->name('role');
        Route::post('/role', [PermissionController::class, 'role_post'])->name('role.post');
        Route::delete('/role/{id}', [PermissionController::class, 'role_destroy'])->name('role.delete');
        Route::put('/role', [PermissionController::class, 'role_update'])->name('role.update');
        Route::put('/user', [PermissionController::class, 'user_role_update'])->name('user.role');
        Route::get('/change-user/{id}', [PermissionController::class, 'edit'])->name('user-role.edit');
        Route::put('users/{id}/update-role', [PermissionController::class, 'updateRoleUser'])->name('users.update-role');
        Route::get('role/{role}/edit', [PermissionController::class, 'edit_role_permission'])->name('role-permission.edit');
        Route::put('role/{role}', [PermissionController::class, 'update_role_permission'])->name('role-permission.update');
        Route::delete('user/{id}', [PermissionController::class, 'destroy'])->name('user.delete');
    });

    // Routes for Siswa (Student), Phone, Hobby, and Blog with permissions
    Route::middleware('permission:siswa-index')->group(function () {
        Route::get('/siswa/index', [DataController::class, 'index'])->name('data');
        Route::get('/show/{id}', [DataController::class, 'detail'])->name('detail');
    });
    Route::middleware('permission:siswa-store')->group(function () {
        Route::post('/post', [DataController::class, 'store'])->name('form.post');
    });
    Route::middleware('permission:siswa-update')->group(function () {
        Route::get('/update/{id}', [DataController::class, 'edit'])->name('data.edit');
        Route::put('/update/{id}', [DataController::class, 'update'])->name('data.update');
    });
    Route::middleware('permission:siswa-delete')->group(function () {
        Route::delete('data/{id}', [DataController::class, 'destroy'])->name('data.delete');
    });

    Route::middleware('permission:phone-index')->group(function () {
        Route::get('/phone/index', [PhoneController::class, 'index'])->name('phone');
        Route::get('/phone/detail/{id}', [PhoneController::class, 'edit'])->name('phone.edit');
    });
    Route::middleware('permission:phone-store')->group(function () {
        // Route::post('/phone/{id}', [PhoneController::class, 'store'])->name('phone.post');
        // Route::post('/phone/post/{id}', [PhoneController::class, 'add'])->name('phone.add');
        Route::post('/phone/{id}', [PhoneController::class, 'store'])->name('phone.post');
        Route::get('/phone/post{id}', [PhoneController::class, 'add'])->name('phone.add');
    });
    Route::middleware('permission:phone-update')->group(function () {
        Route::get('/phone/update/{id}', [PhoneController::class, 'edit2'])->name('phone.edit2');
        Route::put('/phone/update/{id}', [PhoneController::class, 'update'])->name('phone.update');
    });
    Route::middleware('permission:phone-delete')->group(function () {
        Route::delete('/phone/show/{id}', [PhoneController::class, 'destroy'])->name('phone.delete');
    });

    Route::middleware('permission:hobby-index')->group(function () {
        Route::get('/hobby/index', [HobbyController::class, 'index'])->name('hobby');
        Route::get('/hobby/detail', [HobbyController::class, 'detail'])->name('detail.hobby');
        Route::get('/hobby/show/{id}', [HobbyController::class, 'show'])->name('show.hobby');
    });
    Route::middleware('permission:hobby-store')->group(function () {
        Route::post('hobby/detail', [HobbyController::class, 'store'])->name('hobby.post');
        Route::post('/hobby/add', [HobbyController::class, 'storeHobby'])->name('hobby.post');
    });
    Route::middleware('permission:hobby-update')->group(function () {
        Route::get('hobby/detail/{id}', [HobbyController::class, 'editHobby'])->name('hobby.edit');
        Route::get('hobby/update/{id}', [HobbyController::class, 'editHobbySiswa'])->name('hobbysiswa.edit');
        Route::post('hobby/update/{id}', [HobbyController::class, 'updateHobbySiswa'])->name('update.hobbysiswa');
        Route::put('/hobby/detail', [HobbyController::class, 'updateHobby'])->name('hobby.update');
    });
    Route::middleware('permission:hobby-delete')->group(function () {
        Route::delete('/hobby/detail/{id}', [HobbyController::class, 'destroy'])->name('hobby.delete');
    });

    Route::middleware('permission:blog-index')->group(function () {
        Route::get('/blog/blog', [BlogController::class, 'blog'])->name('blog');    
        Route::get('/blog/show_blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
        Route::get('/blog/index', [BlogController::class, 'index'])->name('table.blog');
    });
    Route::middleware('permission:blog-store')->group(function () {
        Route::get('/blog/write', [BlogController::class, 'write'])->name('write');
        Route::post('/blog/write', [BlogController::class, 'store'])->name('blog.post');
    });
    Route::middleware('permission:blog-update')->group(function () {
        Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::put('/blog/edit/{id}', [BlogController::class, 'update'])->name('blog.update');
    });
    Route::middleware('permission:blog-delete')->group(function () {
        Route::delete('/blog/index/{id}', [BlogController::class, 'destroy'])->name('blog.delete');
    });

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    

    // Logout Route
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});



// Route::get('/user', [PermissionController::class, 'index'])->name('user');
// Route::get('/role', [PermissionController::class, 'role'])->name('role');
// Route::post('/role', [PermissionController::class, 'role_post'])->name('role.post');
// Route::delete('/role/{id}', [PermissionController::class, 'role_destroy'])->name('role.delete');
// Route::put('/role', [PermissionController::class, 'role_update'])->name('role.update');
// Route::put('/user', [PermissionController::class, 'user_role_update'])->name('user.role');
// Route::get('/change-user/{id}', [PermissionController::class, 'edit'])->name('user-role.edit');
// Route::put('users/{id}/update-role', [PermissionController::class, 'updateRoleUser'])->name('users.update-role');
// Route::get('role/{role}/edit', [PermissionController::class, 'edit_role_permission'])->name('role-permission.edit');
// Route::put('role/{role}', [PermissionController::class, 'update_role_permission'])->name('role-permission.update');

// // Start Route Content
// Route::middleware('auth')->group(function () {

//     Route::middleware('role:admin|super-admin')->group(function () {
//         Route::get('/siswa/index', [DataController::class, 'index'])->name('data');
//         Route::get('/show/{id}', [DataController::class, 'detail'])->name('detail');
//         Route::get('/phone/index', [PhoneController::class, 'index'])->name('phone');
//         Route::get('/phone/detail/{id}', [PhoneController::class, 'edit'])->name('phone.edit');
//         Route::get('/hobby/index', [HobbyController::class, 'index'])->name('hobby');
//         Route::get('/hobby/detail', [HobbyController::class, 'detail'])->name('detail.hobby');
//         Route::get('/hobby/show/{id}', [HobbyController::class, 'show'])->name('show.hobby');
//         Route::get('/blog/blog', [BlogController::class, 'blog'])->name('blog');
//     });

//     Route::middleware('role:super-admin')->group(function () {
//         Route::get('/update/{id}', [DataController::class, 'edit'])->name('data.edit');
//         Route::put('/update/{id}', [DataController::class, 'update'])->name('data.update');
//         Route::delete('data/{id}', [DataController::class, 'destroy'])->name('data.delete');
        
//         Route::post('/post', [DataController::class, 'store'])->name('form.post');
        
//         Route::post('/phone/{id}', [PhoneController::class, 'store'])->name('phone.post');
//         Route::get('/phone/post{id}', [PhoneController::class, 'add'])->name('phone.add');
//         Route::get('/phone/update/{id}', [PhoneController::class, 'edit2'])->name('phone.edit2');
//         Route::put('/phone/update/{id}', [PhoneController::class, 'update'])->name('phone.update');
//         Route::delete('/phone/show/{id}', [PhoneController::class, 'destroy'])->name('phone.delete');
        
//         Route::get('hobby/detail/{id}', [HobbyController::class, 'editHobby'])->name('hobby.edit');
//         Route::get('hobby/update/{id}', [HobbyController::class, 'editHobbySiswa'])->name('hobbysiswa.edit');
//         Route::post('hobby/update/{id}', [HobbyController::class, 'updateHobbySiswa'])->name('update.hobbysiswa');
//         Route::post('/addhobby/{id}', [HobbyController::class, 'storeaddhobby'])->name('add.hobby.post');
//         Route::delete('/hobby/detail/{id}', [HobbyController::class, 'destroy'])->name('hobby.delete');
//         Route::post('hobby/detail', [HobbyController::class, 'store'])->name('hobby.post');    
//         Route::post('/hobby/add', [HobbyController::class, 'storeHobby'])->name('hobby.post');
//         Route::put('/hobby/detail', [HobbyController::class, 'updateHobby'])->name('hobby.update');

//         Route::get('/blog/write', [BlogController::class, 'write'])->name('write');
//         Route::post('/blog/write', [BlogController::class, 'store'])->name('blog.post');
//         Route::delete('/blog/index/{id}', [BlogController::class, 'destroy'])->name('blog.delete');
//         Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
//         Route::put('/blog/edit/{id}', [BlogController::class, 'update'])->name('blog.update');
//         Route::get('/blog/index', [BlogController::class, 'index'])->name('table.blog');
//         Route::get('/blog/show_blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
//         Route::get('/blog/index', [BlogController::class, 'index'])->name('table.blog');

//     });

//     Route::middleware('role:user|admin|super-admin')->group(function () {
//         Route::get('/blog/blog', [BlogController::class, 'blog'])->name('blog');
//         Route::get('/blog/show_blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
//         Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//     });

//     Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// });





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

