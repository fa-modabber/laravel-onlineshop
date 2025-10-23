<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'sliders'], function () {
    Route::get('/', [SliderController::class, 'index'])->name('sliders.index');
    Route::get('/create', [SliderController::class, 'create'])->name('sliders.create');
    Route::post('/', [SliderController::class, 'store'])->name('sliders.store');
    Route::get('/{slider}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
    Route::put('/{slider}', [SliderController::class, 'update'])->name('sliders.update');
    Route::delete('/{slider}', [SliderController::class, 'destroy'])->name('sliders.destroy');
});

Route::group(['prefix' => 'features'], function () {
    Route::get('/', [FeatureController::class, 'index'])->name('features.index');
    Route::get('/create', [FeatureController::class, 'create'])->name('features.create');
    Route::post('/', [FeatureController::class, 'store'])->name('features.store');
    Route::get('/{feature}/edit', [FeatureController::class, 'edit'])->name('features.edit');
    Route::put('/{feature}', [FeatureController::class, 'update'])->name('features.update');
    Route::delete('/{feature}', [FeatureController::class, 'destroy'])->name('features.destroy');
});

Route::group(['prefix' => 'about-us'], function () {
    Route::get('/', [AboutUsController::class, 'index'])->name('about-us.index');
    Route::get('/{about}/edit', [AboutUsController::class, 'edit'])->name('about-us.edit');
    Route::put('/{about}/edit', [AboutUsController::class, 'update'])->name('about-us.update');
});

Route::group(['prefix' => 'contact-us'], function () {
    Route::get('/', [ContactUsController::class, 'index'])->name('contact-us.index');
    Route::get('/{contact}', [ContactUsController::class, 'show'])->name('contact-us.show');
    Route::delete('/{contact}', [ContactUsController::class, 'destroy'])->name('contact-us.destroy');
});

Route::group(['prefix' => 'footer'], function () {
    Route::get('/', [FooterController::class, 'index'])->name('footer.index');
    Route::get('/{footer}/edit', [FooterController::class, 'edit'])->name('footer.edit');
    Route::put('/{footer}', [FooterController::class, 'update'])->name('footer.update');
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::get('{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::group(['prefix' => 'coupons'], function () {
    Route::get('/', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/create', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('/', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('/{coupon}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
    Route::put('/{coupon}', [CouponController::class, 'update'])->name('coupons.update');
    Route::delete('/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy');
});