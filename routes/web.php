<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CustomerGroupController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SupplierController;
use App\Http\Controllers\Admin\TaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\UnitController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\SaleInvoiceController;
use App\Http\Controllers\Dashboard\PosController;
use App\Http\Controllers\Admin\PosInvoiceController;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-process', [LoginController::class, 'process'])->name('login.process');
Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::post('/register-process', [RegisterController::class, 'process'])->name('register.process');
Route::get('/register/verify/{verification_code}', [RegisterController::class, 'verifyEmail'])
    ->name('register.verify_email');
Route::get('/forget-password', [ForgetPasswordController::class, 'index'])
    ->name('forgetPassword');
Route::post('/forget-password', [ForgetPasswordController::class, 'process'])
    ->name('forgetPassword.process');
Route::get('/reset-password/{resetCode}', [ForgetPasswordController::class, 'resetPassword'])
    ->name('resetPassword');
Route::post('/reset-password/{resetCode}', [ForgetPasswordController::class, 'resetPasswordProcess'])
    ->name('resetPassword.process');

Route::prefix('/')->name('admin.')->middleware(['auth', 'role:Admin|Manager|Seller'])->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('suppliers')->name('suppliers.')->group(function () {
        Route::get('', [SupplierController::class, 'index'])->name('index');
        Route::get('/anyData', [SupplierController::class, 'anyData'])->name('data');
        Route::get('/create', [SupplierController::class, 'create'])->name('create');
        Route::post('/create', [SupplierController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [SupplierController::class, 'update'])->name('edit.update');
        Route::delete('/delete', [SupplierController::class, 'destroy'])->name('delete');
        Route::get('/import-form',[SupplierController::class, 'importForm'])->name('data.import');
        Route::post('/import',[SupplierController::class, 'import'])->name('import');
    });

    Route::prefix('pos')->name('pos.')->group(function () {
        Route::get('', [PosController::class, 'index'])->name('index');
        Route::get('/live-search', [PosController::class, 'search'])->name('search');
        Route::post('/choose-product', [PosController::class, 'chooseProduct'])->name('chooseProduct');
        Route::post('/create-new-pos-invoice', [PosInvoiceController::class, 'create'])->name('createNewInvoices');
    });

    Route::prefix('posInvoices')->name('posInvoices.')->middleware(['role:Admin|Seller'])->group(function () {
        Route::get('', [PosInvoiceController::class, 'index'])->name('index');
        Route::get('/list', [PosInvoiceController::class, 'getList'])->name('list');
        Route::get('/see-detail', [PosInvoiceController::class, 'detail'])->name('detail');
        Route::get('/print-pdf/{posInvoiceId}', [PosInvoiceController::class, 'printPDF'])->name('printPDF');
    });

    Route::prefix('customers')->name('customers.')-> group(function(){
        Route::get('',[CustomerController::class, 'index'])->name('index');
        Route::get('/anyData',[CustomerController::class, 'anyData'])->name('data');
        Route::get('/create',[CustomerController::class, 'create'])->name('create');
        Route::post('/create',[CustomerController::class, 'store'])->name('store');
        Route::get('/edit/{id}',[CustomerController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}',[CustomerController::class, 'update'])->name('edit.update');
        Route::delete('/delete',[CustomerController::class, 'destroy'])->name('delete');
        Route::get('/import-form',[CustomerController::class, 'importForm'])->name('data.import');
        Route::post('/import',[CustomerController::class, 'import'])->name('import');

    });

    Route::prefix('users')->name('users.')->middleware('role:Admin')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/get-list', [UserController::class, 'getList'])->name('getList');
        Route::get('/assign-role/{userId}', [UserController::class, 'assignRole'])->name('assignRole');
        Route::post('/assign-role/{userId}', [UserController::class,
            'assignRoleProcess'])->name('assignRole.process');
        Route::delete('/delete-user', [UserController::class, 'delete'])->name('delete');
    });

    Route::prefix('products')->name('products.')->group(function () {
        Route::get('', [ProductController::class, 'index'])->name('index');
        Route::get('/list', [ProductController::class, 'getList'])->name('getList');
        Route::get('/see-detail', [ProductController::class, 'detail'])->name('detail');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/create', [ProductController::class, 'store'])->name('store');
        Route::delete('/delete', [ProductController::class, 'destroy'])->name('delete');
        Route::get('/edit/{id}',[ProductController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}',[ProductController::class, 'update'])->name('edit.update');
        Route::post('/import-csv', [ProductController::class, 'importCSV'])->name('importCSV');
        Route::delete('/delete', [ProductController::class, 'delete'])->name('delete');
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('index');
        Route::get('/getList', [CategoryController::class, 'getList'])->name('getList');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/create', [CategoryController::class, 'store'])->name('store');
        Route::delete('/delete', [CategoryController::class, 'destroy'])->name('delete');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [CategoryController::class, 'update'])->name('edit.update');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/update-profile/{userId}', [ProfileController::class, 'updateProfile'])
            ->name('updateProfile');
        Route::post('/change-password/{userId}', [ProfileController::class, 'changePassword'])
            ->name('changePassword');
    });

    Route::prefix('units')->name('units.')->group(function () {
        Route::get('/', [UnitController::class, 'index'])->name('index');
        Route::get('/anyData', [UnitController::class, 'anyData'])->name('anyData');
        Route::get('/edit{id}', [UnitController::class, 'edit'])->name('edit');
        Route::put('/edit{id}', [UnitController::class, 'update'])->name('edit.update');
        Route::get('/create', [UnitController::class, 'create'])->name('create');
        Route::post('/create', [UnitController::class, 'store'])->name('store');
        Route::delete('/delete', [UnitController::class, 'destroy'])->name('delete');
    });

    Route::prefix('brands')->name('brands.')->middleware('permission:Thương Hiệu|Mọi Quyền')->group(function () {
        Route::get('', [BrandController::class, 'index'])->name('index');
        Route::get('/anyData', [BrandController::class, 'anyData'])->name('data');
        Route::get('/create', [BrandController::class, 'create'])->name('create');
        Route::post('/create', [BrandController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}', [BrandController::class, 'update'])->name('update');
        Route::delete('/delete', [BrandController::class, 'destroy'])->name('delete');
    });

    Route::prefix('quotations')->name('quotations.')->group(function () {
        Route::get('', [QuotationController::class, 'index'])->name('index');
        Route::get('/edit/{id}', [QuotationController::class, 'edit'])->name('edit');
        Route::put('/edit', [QuotationController::class, 'update'])->name('edit.update');
    });

    Route::prefix('purchases')->name('purchases.')->group(function(){
        Route::get('/', [PurchaseController::class, 'index'])->name('index');
        Route::get('/list', [PurchaseController::class, 'getList'])->name('list');
        Route::get('/create-order', [PurchaseController::class, 'createOrder'])->name('createOrder');
        Route::get('/edit-order/{purchaseOrderId}', [PurchaseController::class, 'editOrder'])->name('editOrder');
        Route::post('/update-order/{purchaseOrderId}', [PurchaseController::class, 'updateOrder'])->name('updateOrder');
        Route::post('/select-product', [PurchaseController::class, 'selectProduct'])->name('selectProduct');
        Route::post('/select-price', [PurchaseController::class, 'selectPrice'])->name('selectPrice');
        Route::post('/create-order', [PurchaseController::class, 'store'])->name('store');
        Route::post('/import-csv', [PurchaseController::class, 'importCSV'])->name('importCSV');
        Route::get('/see-detail', [PurchaseController::class, 'detail'])->name('detail');
        Route::get('/print-pdf/{purchaseOrderId}', [PurchaseController::class, 'printPDF'])->name('printPDF');
        Route::delete('/delete', [PurchaseController::class, 'delete'])->name('delete');
    });

    //Sale Invoices
    Route::prefix('saleInvoices')->name('saleInvoices.')-> group(function(){
        Route::get('',[SaleInvoiceController::class, 'index'])->name('index');
        Route::get('/list', [SaleInvoiceController::class, 'getList'])->name('list');
        Route::get('/create',[SaleInvoiceController::class, 'create'])->name('create');
        Route::get('/edit/{saleInvoiceId}',[SaleInvoiceController::class, 'edit'])->name('edit');
        Route::post('/show-customer-address',[SaleInvoiceController::class, 'showAddress'])->name('showAddress');
        Route::post('/show-product-price',[SaleInvoiceController::class, 'showPrice'])->name('showPrice');
        Route::post('/store-sale-invoice',[SaleInvoiceController::class, 'store'])->name('store');
        Route::post('/update-sale-invoice/{saleInvoiceId}',[SaleInvoiceController::class, 'update'])->name('update');
        Route::get('/see-detail', [SaleInvoiceController::class, 'detail'])->name('detail');
        Route::get('/print-pdf/{purchaseOrderId}', [SaleInvoiceController::class, 'printPDF'])->name('printPDF');
        Route::delete('/delete', [SaleInvoiceController::class, 'delete'])->name('delete');
    });

    // tax
    // Route::resource('taxes', TaxController::class);
    Route::prefix('taxes')->name('taxes.')-> group(function(){
        Route::get('',[TaxController::class, 'index'])->name('index');
        Route::get('/anyData',[TaxController::class, 'anyData'])->name('data');
        Route::get('/create',[TaxController::class, 'create'])->name('create');
        Route::post('/create',[TaxController::class, 'store'])->name('store');
        Route::get('/edit/{id}',[TaxController::class, 'edit'])->name('edit');
        Route::put('/edit/{id}',[TaxController::class, 'update'])->name('update');
        Route::delete('/delete',[TaxController::class, 'destroy'])->name('delete');
    });

    Route::prefix('deliveries')->name('deliveries.')->group(function(){
        Route::get('/', [DeliveryController::class, 'index'])->name('index');
        Route::get('/list', [DeliveryController::class, 'getList'])->name('getList');
        Route::get('/add', [DeliveryController::class, 'create'])->name('create');
        Route::post('/select-delivery', [DeliveryController::class, 'selectDelivery'])->name('selectDelivery');
        Route::post('/add', [DeliveryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [DeliveryController::class, 'edit'])->name('edit');
        Route::post('/edit/{id}', [DeliveryController::class, 'update'])->name('update');
        Route::delete('/delete', [DeliveryController::class, 'delete'])->name('delete');
        Route::post('/show-delivery-fee', [DeliveryController::class, 'showFee'])->name('showFee');
    });

});
