<?php

use App\Http\Middleware\CheckUserType;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CurrencyController;
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
 

Route::get('/recommendations', [ProductController::class, 'showRecommendedProducts'])->name('recommendations');
    
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');


 Route::get('/search', [SearchController::class,'search']);



   Route::get('/products', [ProductController::class,'sort'])->name('products');



    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/success', [CheckoutController::class,'success'])->name('success');
Route::post('/add-to-cart/{id}', [CartController::class, 'add_to_cart'])->name('add_to_cart');
Route::post('/remove-from-cart/{id}', [CartController::class,'remove_from_cart'])->name('remove_from_cart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');

Route::get('/convert-currency/{productId}', [CurrencyController::class, 'convert_currency']);

});

   
   

  
    



require __DIR__.'/auth.php';
