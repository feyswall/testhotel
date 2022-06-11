<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\ExpensesController;


Route::middleware(['auth', 'can:grob_users'])->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::put('/admin/update/profile/{id}', 'AdminsController@updateProfile')->name('admin.updateProfile');
    Route::get('/admin/profile/{id}', 'AdminsController@getProfile')->name('admin.getProfile');

    //Back Office Routes 
    Route::controller(BackofficeController::class)->group(function(){
        Route::get('/backoffice', 'index');
        // Route::get('/employees', 'employees');
        // Route::get('/categories/{type}', 'categories');
        // Route::get('/taxes', 'taxes');
        // Route::get('/customers', 'customers');
        // Route::get('/discounts', 'discounts');
        // Route::get('/attributes', 'attributes');
        // Route::get('/users', 'users');
    });


    //Supplier routes
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/suppliers', 'index');
        Route::get('/suppliers/create', 'create');
        Route::post('/suppliers/store', 'store');
    });

    //Profile Route
    Route::get('/profile', [ProfileController::class, 'profile']);

    //Item routes
    Route::get('/items', [ItemController::class, 'index'])->name('list-items');

    //Warehouse routes
    Route::get('/warehouses', [WarehouseController::class, 'index'])->name('list-warehouses');

    //Stock routes
    Route::get('/stocks', [StockController::class, 'index'])->name('list-stocks');

    //Sales routes
    Route::get('/sales', [SalesController::class, 'index'])->name('sales-list');

    //Purchases routes
    Route::get('/purchases', [PurchasesController::class, 'index'])->name('purchases-list');

    //Expenses routes
    Route::get('/expenses', [ExpensesController::class, 'index'])->name('expenses-list');

});



