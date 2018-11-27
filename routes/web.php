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
        Route::post('historic', 'BalanceController@historicSearch')->name('historic.search');
        
    }
);

Route::get('/', 'Site\SiteController@index')->name('home');

Auth::routes();
