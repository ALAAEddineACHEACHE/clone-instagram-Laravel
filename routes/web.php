<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Auth::routes();

Route::get('/profile/{pseudo}', [HomeController::class, 'index'])->name('home');
Route::get('verify', [HomeController::class, 'verify'])->name('verify');
Route::post('verify', [HomeController::class, 'verifyCode'])->name('verify');
Route::get('profile-edit/{pseudo}', [HomeController::class, 'editProfile'])->name('profile.edit');
Route::put('profile-edit/{pseudo}', [HomeController::class, 'updateProfile'])->name('profile.edit');
Route::put('password-edit/{pseudo}', [HomeController::class, 'changePassword'])->name('password.update');
Route::get('/profile/{pseudo}/addPost', [HomeController::class, 'addPost'])->name('addPost');
Route::resource('post', PostsController::class);
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
Route::post('add-like', [PostsController::class, 'storeLike'])->name('like.store');

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('test', function () {
        return view('test');
    });
});
