<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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
    return redirect('/login');
});

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/view', [EmployeeController::class, 'view'])->name('view');

Route::get('/add', [EmployeeController::class, 'add'])->name('add');
Route::post('/add', [EmployeeController::class, 'addEmployee'])->name('add-post');

Route::get('/payroll', [EmployeeController::class, 'payroll'])->name('payroll');

Route::get('/settings', [EmployeeController::class, 'settings'])->name('settings');
