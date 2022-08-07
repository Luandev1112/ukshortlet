<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function(){
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Start Admin Area
|--------------------------------------------------------------------------
*/


Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/', 'LoginController@showLoginForm')->name('login');
        Route::post('/', 'LoginController@login')->name('login');
        Route::get('logout', 'LoginController@logout')->name('logout');
        // Admin Password Reset
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
        Route::post('password/reset', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('password/verify-code', 'ForgotPasswordController@verifyCode')->name('password.verify-code');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.change-link');
        Route::post('password/reset/change', 'ResetPasswordController@reset')->name('password.change');
    });


    Route::middleware(['admin'])->group(function () {
        // Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('profile', 'AdminController@profile')->name('profile');
        Route::post('profile', 'AdminController@profileUpdate')->name('profile.update');
        Route::get('password', 'AdminController@password')->name('password');
        Route::post('password', 'AdminController@passwordUpdate')->name('password.update');

        Route::get('dashboard', 'InventoryController@index')->name('dashboard');
        // Admin Inventories
        Route::get('inventories', 'InventoryController@index')->name('inventories');
        Route::post('inventories/import', 'InventoryController@import')->name('inventories.import');
        Route::post('inventory/delete', 'InventoryController@inventoryDelete')->name('inventory.delete');
        Route::get('inventory/get/{id}', 'InventoryController@inventoryData')->name('inventory.get');
        Route::post('inventory/update', 'InventoryController@inventoryUpdate')->name('inventory.update');
        Route::get('inventory/getByCode', 'InventoryController@getByStockCode')->name('inventory.getbycode');
        Route::post('inventory/updateStockCode', 'InventoryController@updateStockCode')->name('inventory.updatestock');
    });
});

/*
|--------------------------------------------------------------------------
| Start User Area
|--------------------------------------------------------------------------
*/




Route::get('/', function(){
    return redirect('admin/inventories');
});



