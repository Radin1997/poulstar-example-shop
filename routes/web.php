<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'processRegistration'])->name('process_registration');
Route::post('login', [AuthController::class, 'processLogin'])->name('process_login');
Route::get('/', [PageController::class, 'home'])->name('pages.home');
Route::get('contact', [PageController::class, 'contact'])->name('pages.contact');
Route::get('faqs', [PageController::class, 'faqs'])->name('pages.faqs');
Route::get('policies', [PageController::class, 'policies'])->name('pages.policies');
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::post('add-to-cart/{product}', [CartController::class, 'addToCart'])->name('add_to_cart');
Route::get('delete-from-cart/{product}', [CartController::class, 'deleteFromCart'])->name('delete_from_cart');
Route::get('checkout', CheckoutController::class)->name('checkout');
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
