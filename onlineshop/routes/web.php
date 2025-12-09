<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
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

Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');


Route::prefix('profile')->middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/{user}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/addresses', [ProfileController::class, 'addresses'])->name('profile.addresses');
    Route::get('/addresses/create', [ProfileController::class, 'address_create'])->name('profile.addresses.create');
    Route::post('/addresses', [ProfileController::class, 'address_store'])->name('profile.addresses.store');
    Route::get('/addresses/{address}/edit', [ProfileController::class, 'address_edit'])->name('profile.addresses.edit');
    Route::put('/addresses/{address}', [ProfileController::class, 'address_update'])->name('profile.addresses.update');
    Route::get('/wishlist', [ProfileController::class, 'wishlist'])->name('profile.wishlist');
    Route::get('/wishlist-remove', [ProfileController::class, 'remove_from_wishlist'])->name('profile.wishlist.remove');
    Route::get('/wishlist-add-to', [ProfileController::class, 'wishlist_add_to'])->name('profile.wishlist.add');
});


Route::prefix('cart')->middleware('auth')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/increment', [CartController::class, 'increment'])->name('cart.increment');
    Route::get('/decrement', [CartController::class, 'decrement'])->name('cart.decrement');
    Route::get('/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/checkCoupon', [CartController::class, 'checkCoupon'])->name('cart.check-coupon');
});


