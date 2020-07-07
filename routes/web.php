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
        'namespace' => 'Admin',
        'prefix' => 'admin',
        'as' => 'admin.',
    ], function () {
        Route::get('/', 'DashboardController')->name('dashboard');

        Route::group([
            'namespace' => 'Products',
            'prefix' => 'products',
            'as' => 'products.',
        ], function () {
            Route::get('/', 'ProductController@index')->name('index');
            Route::delete('{product}', 'ProductController@destroy')->name('destroy');
            Route::get('edit/{product}', 'ProductController@edit')->name('edit');
            Route::get('create', 'CreateController@create')->name('create');
            Route::post('/', 'CreateController@store')->name('store');

            Route::resource('categories', 'Category\CategoryController')->except(['show', 'edit', 'create', 'update']);
        });
    });

    Route::group([
        'namespace' => 'User',
        'as' => 'users.',
    ], function () {
        Route::get('/profile', 'DashboardController')->name('dashboard');
        Route::get('/wishlist', 'Wish\IndexController')->name('wish.index');
        Route::resource('addresses', 'Address\AddressController')->except(['show']);
    });
});


