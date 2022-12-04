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

Route::get('/employee/add', [EmployeeController::class, 'add'])->name('add');
Route::post('/employee/add', [EmployeeController::class, 'addEmployee'])->name('add-post');
Route::post('/task/add', [EmployeeController::class, 'addTask'])->name('add.task');

Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('emp.edit');
Route::put('/employee/edit/{id}', [EmployeeController::class, 'editEmployee'])->name('emp.edit.put');
Route::delete('/employee/delete/{id}', [EmployeeController::class, 'delete'])->name('emp.delete');

Route::get('/task/add', [EmployeeController::class, 'task'])->name('task');

Route::get('/settings', [EmployeeController::class, 'settings'])->name('settings');
