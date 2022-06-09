<?php

use App\Http\Controllers\BackOfficeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'can:grob_users'])->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::put('/admin/update/profile/{id}', 'AdminsController@updateProfile')->name('admin.updateProfile');
    Route::get('/admin/profile/{id}', 'AdminsController@getProfile')->name('admin.getProfile');

    //Back Office Routes 
    Route::get('/back_office_page', [BackOfficeController::class, 'landing_page']);
    Route::get('/employees', [BackOfficeController::class, 'employees']);
    Route::get('/categories/{type}', [BackOfficeController::class, 'categories']);
    Route::get('/suppliers', [BackOfficeController::class, 'suppliers']);
    Route::get('/taxes', [BackOfficeController::class, 'taxes']);
    Route::get('/customers', [BackOfficeController::class, 'customers']);
    Route::get('/discounts', [BackOfficeController::class, 'discounts']);
    Route::get('/attributes', [BackOfficeController::class, 'attributes']);
    Route::get('/users', [BackOfficeController::class, 'users']);
});



