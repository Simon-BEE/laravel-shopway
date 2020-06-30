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

    Route::group([
        'middleware' => ['role:admin'],
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'as' => 'admin.',
    ], function () {
        Route::get('/', 'DashboardController')->name('dashboard');
    });

    Route::get('/profile', 'User\DashboardController')->name('users.dashboard');
    Route::get('/wishlist', 'User\Wish\IndexController')->name('users.wish.index');
});


