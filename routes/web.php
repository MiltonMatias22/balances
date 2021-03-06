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

Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(
    function ()
    {
        Route::get('/', 'AdminController@index')->name('admin');
        Route::get('balance', 'BalanceController@index')->name('balance');
        Route::get('deposit', 'BalanceController@deposit')->name('balance.deposit');
        Route::post('deposit', 'BalanceController@depositStore')->name('deposit.store');
        Route::get('withdraw', 'BalanceController@withdraw')->name('balance.withdraw');
        Route::post('withdraw', 'BalanceController@withdrawStore')->name('withdraw.store');
        Route::get('transfer', 'BalanceController@transfer')->name('balance.transfer');
        Route::post('confirm-transfer', 'BalanceController@confirmTransfer')->name('confirm.transfer');
        Route::post('transfer', 'BalanceController@transferStore')->name('transfer.store');
        Route::get('historic', 'BalanceController@historic')->name('admin.historic');
        Route::any('historic-search', 'BalanceController@historicSearch')->name('historic.search');
        
    }
);

Route::get('/', 'Site\SiteController@index')->name('home');
Route::get('my-profile', 'Admin\UserController@profile')->name('profile')->middleware('auth');
Route::post('update-profile', 'Admin\UserController@updateProfile')->name('update.profile')->middleware('auth');

Auth::routes();
