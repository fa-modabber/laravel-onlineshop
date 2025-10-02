<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

Route::group(['prefix' => 'contact-us'], function () {
    Route::get('/', [ContactUsController::class, 'index'])->name('contact-us.index');
    Route::post('/', [ContactUsController::class, 'store'])->name('contact-us.store');
});

Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/menu', [ProductController::class, 'menu'])->name('products.menu');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.loginForm');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/check-otp', [AuthController::class, 'check_otp'])->name('auth.check-otp');
    Route::post('/resend-otp', [AuthController::class, 'resend_otp'])->name('auth.resend-otp');
});

Route::prefix('profile')->middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/{user}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/addresses', [ProfileController::class, 'addresses'])->name('profile.addresses');
    Route::get('/addresses/create', [ProfileController::class, 'address_create'])->name('profile.addresses.create');
    Route::post('/addresses', [ProfileController::class, 'address_store'])->name('profile.addresses.store');
    Route::get('/addresses/{address}/edit', [ProfileController::class, 'address_edit'])->name('profile.addresses.edit');
    Route::put('/addresses/{address}', [ProfileController::class, 'address_update'])->name('profile.addresses.update');
    Route::get('/wishlist', [ProfileController::class, 'wishlist'])->name('profile.wishlist');
});

Route::prefix('wishlist')->group(function () {
    Route::get('/add-to', [ProfileController::class, 'wishlist_add_to'])->name('wishlist-add-to');
});
