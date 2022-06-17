<?php

use App\Http\Controllers\Admin\AttributesController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\ItemController;
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
    Route::controller(ItemController::class)->group(function(){
        Route::get('/items', 'index')->name('admin.items.index');
        Route::get('/items/create', 'create')->name('admin.items.create');
        Route::get('/items/search/{text}', 'search')->name('admin.items.search');
        Route::post('/items/store', 'store')->name('admin.items.store');
        Route::post('/items/import', 'importItems')->name('admin.items.import');
        Route::delete('/items/delete/{id}', 'destroy')->name('admin.items.delete');
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
        Route::get('/customers/search/{text}', 'search');
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

    //Setting routes
    Route::controller(SettingController::class)->group(function(){
        Route::get('/settings', 'index');
        Route::get('/methods', 'payment_methods');
        Route::post('/save_method', 'save_method');
        Route::put('/update_setting', 'update');
        Route::put('/methods/edit/{id}', 'update_method');
    });

    //Supplier routes
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/suppliers', 'index')->name('admin.supplier.index');
        Route::get('/suppliers/create', 'create')->name('admin.supplier.create');
        Route::post('/suppliers/store', 'store')->name('admin.supplier.store');
        Route::get('/suppliers/edit/{id}', 'edit')->name('admin.supplier.edit');
        Route::put('/suppliers/update/{id}', 'update')->name('admin.supplier.update');
        Route::delete('/suppliers/delete/{id}', 'destroy')->name('admin.supplier.destroy');

    });

    //Profile Route
    Route::get('/profile', [ProfileController::class, 'profile']);
    Route::put('/profile_update/{id}', [ProfileController::class, 'update_details'])->name('profile_update');
    Route::put('/password_udpate/{id}', [ProfileController::class, 'password_udpate'])->name('password_udpate');

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
        Route::get('/proforma/{id}', 'proforma');
        Route::put('/sales/make_invoice/{id}', 'make_invoice');
        Route::put('/sales/confirm_invoice/{id}', 'confirm_invoice');
        Route::put('/sales/undo/{id}', 'undo');
        Route::put('/sales/set_discount/{id}', 'set_discount');
        Route::put('/sales/set_cash/{id}', 'set_cash');
        Route::post('/save_sales', 'store')->name('sales.store');
        Route::delete('/remove_order/{id}', 'destroy')->name('sales.destroy');
        Route::get('/print/sales/invoice/{sale}', 'printInvoice')->name('print.sales.invoice');
    });

    //Purchases routes
    Route::get('/purchases', [PurchasesController::class, 'index'])->name('purchases-list');

    //Expenses routes
    Route::get('/expenses', [ExpensesController::class, 'index'])->name('expenses-list');

});
