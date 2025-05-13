<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;



//kode baru diubah menjadi seperti ini
Route::get('/dashboard', [HomepageController::class, 'index'])->name('home');
Route::get('products', [HomepageController::class, 'products']) ->name('products');
Route::get('product/{slug}', [HomepageController::class, 'product']);
Route::get('categories', [HomepageController::class, 'categories'])->name('categories');
Route::get('category/{slug}', [HomepageController::class, 'category']);
Route::get('cart', [HomepageController::class, 'cart']);
Route::get('checkout', [HomepageController::class, 'checkout']);


Route::group(['prefix'=>'dashboard'], function(){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    Route::resource('categories', ProductCategoryController::class);
    Route::resource('products', ProductController::class)->names([
        'index' => 'dashboard.products.index',
        'create' => 'dashboard.products.create',
        'store' => 'dashboard.products.store',
        'edit' => 'dashboard.products.edit',
        'update' => 'dashboard.products.update',
        'destroy' => 'dashboard.products.destroy',
    ]);
    })->middleware(['auth', 'verified']);


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';