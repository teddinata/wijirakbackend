<?php

use App\Http\Controllers\FrontEnd\FrontendController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('contact', 'HomeController@contact')->name('contact');
Route::get('shop', 'ShopController@index')->name('shop');

// Route::get('product', 'DetailProductController@index')->name('product');
Route::get('detail/{slug}', 'DetailProductController@index')->name('products.detail');



Route::middleware(['auth', 'verified'])->group(function () {
    // user profile
    Route::get('profile', 'UserController@index')->name('profile');

    // bukti bayar
    Route::get('/transaksi/bukti-bayar/{id}', 'UserController@buktiBayar')->name('bukti-bayar');
    // store bukti Bayar
    Route::post('/transaksi/bukti-bayar/{id}', 'UserController@storeBuktiBayar')->name('store-bukti-bayar');

    Route::get('cart', 'CartController@cart')->name('cart');
    // Route::get('cart', 'CartController@cartHeader')->name('cartHeader');
    Route::post('cart/{id}', 'CartController@cartAdd')->name('cart.add');
    Route::post('updatecart/{id}', 'CartController@decrementCart')->name('cart.decrement');
    // Route::patch('/update_cart', 'CartController@update_cart')->name('update_cart');
    Route::delete('cart/{id}', 'CartController@cartDelete')->name('cart.delete');

    Route::get('checkout', 'CheckoutController@index')->name('checkout');
    Route::post('checkout_process', 'CheckoutController@process')
                ->name('checkout.process');
    // Route::post('checkout/{id}', 'CartController@checkout_process')->name('checkout_process');
    Route::get('/checkout/success', 'CheckoutController@success')->name('success');
});

Route::prefix('admin')
        ->namespace('Admin')
        ->middleware(['auth', 'admin'])
        ->group(function() {

        Route::get('/', 'DashboardController@index')->name('dashboard');

        // route for pembayaran
        Route::get('/pembayaran/{id}', 'PaymentController@index')->name('pembayaran');
        // Route::get('/pembayaran', 'PaymentController@index')->name('pembayaran');


        // Route::get('/login', 'Admin\AdminController@login')->name('admin.login');
        // Route::post('/login', 'Admin\AdminController@postLogin')->name('admin.postLogin');
        // Route::get('/logout', 'Admin\AdminController@logout')->name('admin.logout');

        Route::resource('category', 'CategoryController');

        // Products routes
        Route::get('products/check_slug', 'ProductController@checkSlug')->name('products.checkSlug');

        Route::resource('products', 'ProductController');

        Route::get('products/{id}/gallery', 'ProductController@gallery')
                ->name('products.gallery');
        Route::resource('product-galleries', 'ProductGalleryController');
        Route::get('transactions/{id}/set-status', 'TransactionController@setStatus')
                ->name('transactions.status');
        Route::resource('transactions', 'TransactionController');
    });

Auth::routes(['register' => true]);







