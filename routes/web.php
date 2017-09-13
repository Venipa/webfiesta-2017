<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('view:home');

Route::group(['middleware' => ['guest']], function() {
    Route::get('/login', 'Authentication\AuthController@login')->name('login');
    Route::post('/login', 'Authentication\AuthController@login_post')->name('post:login');
    Route::get('/register', 'Authentication\AuthController@register')->name('register');
    Route::post('/register', 'Authentication\AuthController@register_post')->name('post:register');
    Route::post('password/email', 'Authentication\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset', 'Authentication\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/reset', 'Authentication\ResetPasswordController@reset');
    Route::get('password/reset/{token}', 'Authentication\ResetPasswordController@showResetForm')->name('password.reset');


});

Route::group(['middleware' => ['web', 'auth']], function() {
    Route::get('/account', 'User\AccountController@account')->name('get:account');
    Route::get('/account/characters', 'User\AccountController@account_characters')->name('get:account.characters');


    Route::post('/api/passchange', 'User\AccountController@changePassword')->name('post:passchange');
    Route::get('/logout', 'Authentication\AuthController@logout')->name('get:logout');

    //Shop
    if(config('app.mall')) {
        Route::get('shop', 'Shop\ShopController@index')->name('get:shop');
        Route::get('shop/cat-{cat}', 'Shop\ShopController@index_wCat')->name('get:shop:cat');
        Route::get('shop/buy-{id}', 'Shop\ShopController@buy')->name('get:shop:buy');
        Route::post('shop/buy-{id}', 'Shop\ShopController@buy_post')->name('post:shop:buy');
        Route::post('api/cardredeem', 'Shop\ShopController@redeemCard')->name('post:giftcode');
        Route::get('rate', 'Shop\ShopController@rate')->name('get:shop:rate');
        Route::get('downloads', function() {
            return view('user.downloads');
        })->name('get:downloads');
    }
});
if(config('app.mall')) {
    Route::any('getcard/{uniq?}', 'Shop\ShopController@generateCode')->name('get:shop:code');
}