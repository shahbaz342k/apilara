<?php

use App\Http\Controllers\WpApi;
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


Route::get('/',[WpApi::class,'get_all_data'])->name('home');
Route::get('cart', [WpApi::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [WpApi::class, 'addToCart'])->name('add_to_cart');
Route::patch('update-cart', [WpApi::class, 'update'])->name('update_cart');
Route::delete('remove-from-cart', [WpApi::class, 'remove'])->name('remove_from_cart');
Route::get('checkout', [WpApi::class, 'checkout'])->name('checkout_cart');
Route::get('thank-you', [WpApi::class, 'thank_you'])->name('thank_you');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
