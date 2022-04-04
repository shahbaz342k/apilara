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
Route::get('user/order-details/{orderid}', [WpApi::class, 'order_details'])->name('order_details');

// Admin route
Route::get('/dashboard/order-details/{orderid}',[WpApi::class, 'admin_orders_details'])->name('admin_orders_details');

Route::post('/dashboard/order-update/{orderid}',[WpApi::class, 'admin_order_update'])->name('admin_order_update');

Route::get('/dashboard/oders',[WpApi::class, 'admin_orders'])->name('admin_orders');
Route::get('/dashboard/users',[WpApi::class, 'admin_users'])->name('admin_users');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
