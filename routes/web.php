<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/',
    //return view('welcome');
    [ProductController::class, 'index']
);

Route::get(
    '/dashboard', 
    [ProductController::class, 'showAll']
)->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('products', ProductController::class)
    ->only(['show'])
    ->middleware(['auth', 'verified']);

Route::post(
    '/purchase',
    [ProductController::class, 'purchase']
)->middleware(['auth', 'verified'])->name('products.purchase');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
