<?php

use App\Http\Controllers\Admin\AttributesController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\WarehousesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\ExpensesController;

Route::middleware(['auth', 'can:grob_users'])->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::put('/admin/update/profile/{id}', 'AdminsController@updateProfile')->name('admin.updateProfile');
    Route::get('/admin/profile/{id}', 'AdminsController@getProfile')->name('admin.getProfile');


    //Items routes
    Route::controller(ProductController::class)->group(function(){
        Route::get('/items', 'index');
        Route::get('/items/create', 'create');
        Route::post('/items/store', 'store');
    });

    //Back Office Routes
    Route::controller(BackofficeController::class)->group(function(){
        Route::get('/backoffice', 'index');
    });

    //Employees routes
    Route::controller(EmployeesController::class)->group(function(){
        Route::get('/employees', 'index');
    });

    //Attributes routes
    Route::controller(AttributesController::class)->group(function(){
        Route::get('/attributes', 'index');
    });

    //Customer routes
    Route::controller(CustomersController::class)->group(function(){
        Route::get('/customers', 'index')->name('customers.index');
        Route::get('/customers/create', 'create');
        Route::post('/customers/store', 'store');
        Route::get('/customers/{id}', 'show');
        Route::put('/customers/update/{id}', 'update')->name('admin.customer.update');
        Route::delete('/customers/delete/{id}', 'destroy')->name('admin.customer.destroy');

    });

    //Members routes
    Route::controller(MembersController::class)->group(function(){
        Route::get('/users', 'index');
    });

    //Categories routes
    Route::controller(CategoriesController::class)->group(function(){
        Route::get('/categories/{type}', 'index');
    });

    //Discounts routes
    Route::controller(DiscountsController::class)->group(function(){
        Route::get('/discounts', 'index');
    });

    //Tax routes
    Route::controller(TaxController::class)->group(function(){
        Route::get('/taxes', 'index');
    });

    //Supplier routes
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/suppliers', 'index')->name('admin.supplier.index');
        Route::get('/suppliers/create', 'create')->name('admin.supplier.create');
        Route::post('/suppliers/store', 'store')->name('admin.supplier.store');
        Route::get('/suppliers/edit/{id}', 'edit')->name('admin.supplier.edit');
        Route::get('/suppliers/delete/{id}', 'delete')->name('admin.supplier.delete');

    });

    //Profile Route
    Route::get('/profile', [ProfileController::class, 'profile']);

    //Warehouse routes
    Route::controller(WarehousesController::class)->group(function(){
        Route::get('/warehouses', 'index');
        Route::get('/warehouses/create', 'create');
        Route::post('/warehouses/store', 'store');
    });

    //Stock routes
    Route::get('/stocks', [StockController::class, 'index'])->name('list-stocks');

    //Sales routes
    Route::controller(SalesController::class)->group(function(){
        Route::get('/sales/{mode}', 'index');
        Route::get('/new_sales', 'create');
        Route::post('/save_sales', 'store');
    });

    //Purchases routes
    Route::get('/purchases', [PurchasesController::class, 'index'])->name('purchases-list');

    //Expenses routes
    Route::get('/expenses', [ExpensesController::class, 'index'])->name('expenses-list');

});



