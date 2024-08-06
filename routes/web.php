<?php

use App\Http\Middleware\CheckUserType;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

  Route::get('/home', [ProductController::class,'home'])->name('home');
   

Route::get('/admin', [ProductController::class,'admin'])->name('admin')->middleware('usertype');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');


//  Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
//     Route::post('/cart/{id}', [CartController::class, 'store'])->name('cart.store');
//     Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
//     Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

 Route::get('/search', [SearchController::class,'search']);


//  Route::get('/products', [ProductController::class,'index'])->name('products.index');
   Route::get('/products', [ProductController::class,'sort'])->name('products');



    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/success', [CheckoutController::class,'success'])->name('success');
Route::post('/add-to-cart/{id}', [CartController::class, 'add_to_cart'])->name('add_to_cart');
Route::post('/remove-from-cart/{id}', [CartController::class,'remove_from_cart'])->name('remove_from_cart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');



});

   
   

  
    



require __DIR__.'/auth.php';
