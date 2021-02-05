<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BatchsController;
use App\Http\Controllers\PricesController;
use App\Http\Controllers\TableeditController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/store', [StoreController::class, 'store']);
Route::get('/customers', [CustomersController::class, 'list']);
Route::get('/customers/create', [CustomersController::class, 'create']);
Route::post('/customers/create', [CustomersController::class, 'create']);
Route::get('/customers/{id}/edit', [CustomersController::class, 'edit']);
Route::post('/customers/{id}/edit', [CustomersController::class, 'edit']);
Route::get('/customers/{id}/delete', [CustomersController::class, 'delete']);
Route::post('/customers/{id}/delete', [CustomersController::class, 'delete']);
Route::get('/orders', function(){return view('orders.list_view');});
Route::get('/orders/create', [OrdersController::class, 'create']);
// products
Route::get('/products', [ProductsController::class, 'list']);
Route::get('/products/create', [ProductsController::class, 'create']);
Route::post('/products/create', [ProductsController::class, 'create']);
Route::get('/products/{id}/edit', [ProductsController::class, 'update']);
Route::post('/products/{id}/edit', [ProductsController::class, 'update']);
Route::get('/products/{product_id}/{batch_id}/{qty}', [ProductsController::class, 'product_price']);

// batchs
Route::get('batchs/{product_id}', [BatchsController::class, 'batchs'])->name('batchs.get');
Route::post('batchs/{product_id}/create', [BatchsController::class, 'create'])->name('batchs.create');
Route::post('batchs/{batch_id}/update', [BatchsController::class, 'update'])->name('batchs.update');

//Prices
Route::get('prices/{batch_id}', [PricesController::class, 'list']);
Route::post('prices/{batch_id}/create', [PricesController::class, 'create'])->name('prices.create');
Route::post('prices/{price_id}/update', [PricesController::class, 'update'])->name('prices.update');

