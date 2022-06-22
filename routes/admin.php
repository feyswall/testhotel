<?php

use App\Http\Controllers\Admin\AttributesController;
use App\Http\Controllers\Admin\ContractsController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\WarehousesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StocksController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\ExpensesController;

Route::middleware(['auth', 'can:grob_users'])->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::put('/admin/update/profile/{id}', 'AdminsController@updateProfile')->name('admin.updateProfile');
    Route::get('/admin/profile/{id}', 'AdminsController@getProfile')->name('admin.getProfile');


    //Items routes
    Route::middleware(['auth', 'can:grob_users'])->controller(ItemController::class)->group(function(){
        Route::get('/items', 'index')->name('admin.items.index');
        Route::get('/items/create', 'create')->name('admin.items.create');
        Route::get('/items/search/{text}', 'search')->name('admin.items.search');
        Route::post('/items/store', 'store')->name('admin.items.store');
        Route::post('/items/import', 'importItems')->name('admin.items.import');
        Route::delete('/items/delete/{id}', 'destroy')->name('admin.items.delete');
        Route::get('/items/edit/{id}', 'edit')->name('admin.items.edit');
        Route::put('/items/{id}/update', 'update')->name('admin.items.update');

        // second item search with vue
        Route::post('/items/in/search', 'inSearch')->name('admin.items.inSearch');

    });

    //Back Office Routes
    Route::middleware(['auth', 'can:grob_users'])->controller(BackofficeController::class)->group(function(){
        Route::get('/backoffice', 'index');
    });

    //Contracts routes
    Route::middleware(['auth', 'can:grob_users'])->controller(ContractsController::class)->group(function(){
        Route::get('/contracts', 'index')->name('contracts.index');
        Route::post('/contracts/store', 'store')->name('contract.store');
        Route::get('/contracts/create', 'create')->name('contract.create');
        Route::get('/contracts/show/{id}', 'show')->name('contract.show');
        Route::put('/contracts/{id}/update', 'update')->name('contract.update');
    });

    //Employees routes
    Route::middleware(['auth', 'can:grob_users'])->controller(EmployeesController::class)->group(function(){
        Route::get('/employees', 'index')->name('employees.index');
        Route::post('/employees', 'store')->name('employees.store');
        Route::delete('/employees', 'destroy')->name('employees.delete');
        Route::get('/employees/create', 'create')->name('employees.create');
        Route::get('/employees/edit/{id}', 'edit')->name('employees.edit');
        Route::put('/employees/{id}', 'update')->name('employees.update');

    });

    //Attributes routes
    Route::middleware(['auth', 'can:grob_users'])->controller(AttributesController::class)->group(function(){
        Route::get('/attributes', 'index');
    });

    //Customer routes
    Route::middleware(['auth', 'can:grob_users'])->controller(CustomersController::class)->group(function(){
        Route::get('/customers', 'index')->name('customers.index');
        Route::get('/customers/create', 'create');
        Route::get('/customers/search/{text}', 'search');
        Route::post('/customers/store', 'store');
        Route::get('/customers/{id}', 'show');
        Route::put('/customers/update/{id}', 'update')->name('admin.customer.update');
        Route::delete('/customers/delete/{id}', 'destroy')->name('admin.customer.destroy');

    });

    //Members routes
    Route::middleware(['auth', 'can:grob_users'])->controller(MembersController::class)->group(function(){
        Route::get('/users', 'index');
    });

    //Categories routes
    Route::middleware(['auth', 'can:grob_users'])->controller(CategoriesController::class)->group(function(){
        Route::get('/categories/{type}', 'index');
        Route::post('/save_category', 'store');
        Route::put('/category/edit/{id}', 'update');
    });

    //Discounts routes
    Route::middleware(['auth', 'can:grob_users'])->controller(DiscountsController::class)->group(function(){
        Route::get('/discounts', 'index');
    });

    //Tax routes
    Route::middleware(['auth', 'can:grob_users'])->controller(TaxController::class)->group(function(){
        Route::get('/taxes', 'index');
        Route::post('/save_tax', 'store');
        Route::put('/tax/edit/{id}', 'update');
    });

    //Setting routes
    Route::middleware(['auth', 'can:grob_users'])->controller(SettingController::class)->group(function(){
        Route::get('/settings', 'index');
        Route::get('/methods', 'payment_methods');
        Route::post('/save_method', 'save_method');
        Route::put('/update_setting', 'update');
        Route::put('/methods/edit/{id}', 'update_method');
    });

    //Supplier routes
    Route::middleware(['auth', 'can:grob_users'])->controller(SupplierController::class)->group(function () {
        Route::get('/suppliers', 'index')->name('admin.supplier.index');
        Route::get('/suppliers/create', 'create')->name('admin.supplier.create');
        Route::post('/suppliers/store', 'store')->name('admin.supplier.store');
        Route::get('/suppliers/edit/{id}', 'edit')->name('admin.supplier.edit');
        Route::put('/suppliers/update/{id}', 'update')->name('admin.supplier.update');
        Route::delete('/suppliers/delete/{id}', 'destroy')->name('admin.supplier.destroy');

    });

    //Profile Route
    Route::middleware(['auth', 'can:grob_users'])->get('/profile', [ProfileController::class, 'profile']);
    Route::put('/profile_update/{id}', [ProfileController::class, 'update_details'])->name('profile_update');
    Route::put('/password_udpate/{id}', [ProfileController::class, 'password_udpate'])->name('password_udpate');

    //Warehouse routes
    Route::middleware(['auth', 'can:grob_users'])->controller(WarehousesController::class)->group(function(){
        Route::get('/warehouses', 'index');
        Route::get('/warehouses/create', 'create');
        Route::post('/warehouses/store', 'store');
    });

    //Stock routes
    Route::get('/stocks', [StocksController::class, 'index'])->name('admin.stock.index');
    Route::get('/stocks/create', [StocksController::class, 'create'])->name('admin.stock.create');
    Route::post('/stocks/store', [StocksController::class, 'store'])->name('admin.stock.store');
    Route::get('/stocks/edit/{id}', [StocksController::class, 'edit'])->name('admin.stock.edit');
    Route::put('/stocks/{id}/update', [StocksController::class, 'update'])->name('admin.stock.update');

    //Sales routes
    Route::middleware(['auth', 'can:grob_users'])->controller(SalesController::class)->group(function(){
        Route::get('/preview_sale/{id}', 'preview');
        Route::get('/sales/{mode}', 'index');
        Route::get('/new_sales', 'create');
        Route::get('/proforma/{id}', 'proforma');
        Route::put('/sales/make_invoice/{id}', 'make_invoice');
        Route::put('/sales/confirm_invoice/{id}', 'confirm_invoice');
        Route::put('/sales/undo/{id}', 'undo');
        Route::put('/sales/set_discount/{id}', 'set_discount');
        Route::put('/sales/set_cash/{id}', 'set_cash')->name('sales.set.cash');
        Route::post('/save_sales', 'store')->name('sales.store');
        Route::delete('/remove_order/{id}', 'destroy')->name('sales.destroy');
        Route::get('/print/sales/invoice/{sale}', 'printInvoice')->name('print.sales.invoice');
    });

    //Purchases routes
    Route::get('/purchases', [PurchasesController::class, 'index'])->name('purchases-list');

    //Expenses routes
    Route::get('/expenses', [ExpensesController::class, 'index'])->name('expenses-list');
    Route::get('/create_expenses', [ExpensesController::class, 'create'])->name('create-expenses');
    Route::post('add_expenses', [ExpensesController::class, 'store'])->name('store-expenses');
    Route::get('edit_expenses/{id}', [ExpensesController::class, 'update'])->name('expenses-edit');
    Route::put('update_expenses/{id}', [ExpensesController::class, 'save'])->name('expense-save');
    Route::get('delete_expenses/{id}', [ExpensesController::class, 'delete'])->name('delete-expense');
});
