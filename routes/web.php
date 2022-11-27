<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;

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

Route::get('/test', [TestController::class, 'test']);

Route::get("/wild/{id}", [TestController::class, 'wild']);

Route::get('/customer', [CustomerController::class, 'getCustomer'])->name('customer.all')->middleware("auth");
Route::post('/customer', [CustomerController::class, 'create'])->name("customer.create");
Route::get('/customer/add', [CustomerController::class, 'toCreate'])->name("customer.add");
Route::get('/customer/{id}', [CustomerController::class, 'getCustomerById'])->name("customer.get")->middleware("auth");
Route::delete('/customer/delete/{id}', [CustomerController::class, 'delete'])->name("customer.delete")->middleware("auth");

Auth::routes([
    'register' => false,
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
