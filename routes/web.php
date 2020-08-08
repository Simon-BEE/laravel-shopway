<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'WelcomeController')->name('welcome');

Route::get('/products', 'Product\IndexController')->name('products.index');

Route::view('/contact', 'contact')->name('contact');

Route::get('/cart', 'Cart\CartController@index')->name('cart.index');

Route::get('/products/{product:slug}', 'Product\ShowController')->name('products.show');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    /**
     * Admin routes
     */
    Route::group([
        'middleware' => ['role:admin'],
        'namespace' => 'Admin',
        'prefix' => 'admin',
        'as' => 'admin.',
    ], function () {
        Route::get('/', 'DashboardController')->name('dashboard');

        // ADMIN PRODUCTS
        Route::group([
            'namespace' => 'Products',
        ], function () {
            Route::resource('products', 'ProductController')->only(['index', 'destroy', 'edit']);
            Route::group(['as' => 'products.', 'prefix' => 'products'], function () {
                Route::get('create', 'CreateController@create')->name('create');
                Route::post('/', 'CreateController@store')->name('store');
                Route::resource('categories', 'Category\CategoryController')->except(['show', 'edit', 'create', 'update']);
            });
        });

        // ADMIN USERS
        Route::group([
            'namespace' => 'User',
        ], function () {
            Route::resource('users', 'UserController')->only(['index']);
        });
    });

    /**
     * User dashboard routes
     */
    Route::group([
        'namespace' => 'User',
        'as' => 'users.',
    ], function () {
        Route::get('/profile', 'DashboardController')->name('dashboard');
        Route::get('/wishlist', 'Wish\IndexController')->name('wish.index');
        Route::resource('addresses', 'Address\AddressController')->except(['show', 'edit', 'update']);

        /**
         * Orders routes
         */
        Route::group([
            'prefix' => 'orders',
            'as' => 'orders.',
            'namespace' => 'Order',
        ], function () {
            Route::get('/', 'OrderController@index')->name('index');
            Route::get('/{order}', 'OrderController@show')->name('show');
        });
    });

    /**
     * Checkout routes
     */
    Route::group([
        'middleware' => ['cart', 'address'],
        'prefix' => 'checkout',
        'as' => 'checkout.',
        'namespace' => 'Checkout',
    ], function () {
        Route::get('/', 'CheckoutController@index')->name('index');
        Route::get('/error', 'CheckoutController@error')->name('error');
        Route::post('/payment/intent', 'CheckoutController@paymentIntent')->name('payment.intent');
        Route::post('/order/store', 'CheckoutController@storingOrder')->name('order.store');
    });
    Route::get('/checkout/success', 'Checkout\CheckoutController@successful')->name('checkout.successful');
});


