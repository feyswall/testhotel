<?php

use App\Http\Controllers\BackOfficeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'can:grob_users'])->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::put('/admin/update/profile/{id}', 'AdminsController@updateProfile')->name('admin.updateProfile');
    Route::get('/admin/profile/{id}', 'AdminsController@getProfile')->name('admin.getProfile');

    //Back Office Routes 
    Route::get('/back_office_page', [BackOfficeController::class, 'landing_page']);
});



