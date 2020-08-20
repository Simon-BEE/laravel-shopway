<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin web routes for your application. 
| These routes are loaded by the RouteServiceProvider within a group which 
| contains "web", "auth" and "role:admin" middleware groups.
|
*/


Route::get('/', 'DashboardController')->name('dashboard');

// ADMIN PRODUCTS
Route::group([
    'namespace' => 'Products',
], function () {
    Route::resource('products', 'ProductController')->only(['index', 'destroy', 'edit']);
    Route::group(['as' => 'products.', 'prefix' => 'products'], function () {
        Route::get('create', 'CreateController@create')->name('create');
        Route::post('/', 'CreateController@store')->name('store');

        Route::group(['namespace' => 'Option', 'as' => 'options.', 'prefix' => '{product}/options'], function () {
            Route::get('create', 'ProductOptionController@create')->name('create');
            Route::post('/', 'ProductOptionController@store')->name('store');
            Route::get('edit/{option}', 'ProductOptionController@edit')->name('edit');
            Route::patch('{option}', 'ProductOptionController@update')->name('update');
            Route::delete('{option}', 'ProductOptionController@destroy')->name('destroy');
        });

        Route::resource('categories', 'Category\CategoryController')->except(['show', 'edit', 'create', 'update']);
    });
});

// ADMIN USERS
Route::group([
    'namespace' => 'User',
], function () {
    Route::resource('users', 'UserController')->only(['index', 'show', 'destroy']);
    Route::resource('addresses', 'AddressController')->only(['destroy']);
});

// ADMIN ORDERS
Route::group([
    'namespace' => 'Order',
], function () {
    Route::resource('orders', 'OrderController')->only(['index', 'show']);
});

// ADMIN SETTINGS

Route::group([
    'namespace' => 'Settings',
    'as' => 'settings.',
    'prefix' => 'settings',
], function () {
    Route::get('/', 'IndexController')->name('index');
    Route::get('/backup', 'BackupController@index')->name('backup.index');
    Route::post('/backup/download', 'BackupController@download')->name('backup.download');
    Route::post('/backup/database', 'BackupController@database')->name('backup.database');
    Route::post('/backup/clean', 'BackupController@clean')->name('backup.clean');
});
