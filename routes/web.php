<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
    return redirect(route('home'));
});

// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');


Route::get('/admin/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('admin.login');


Route::post('/admin/logout', [LoginController::class, 'adminLogout'])->name('admin.logout');

Route::get('/admin/register', [RegisterController::class, 'showAdminRegistrationForm'])->name('admin.register-view');
Route::post('/admin/register', [RegisterController::class, 'createAdmin'])->name('admin.register');

Route::get('/admin', function () {
    return view('admin.home');
})->middleware('auth:admin');


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

Auth::routes([
    'register' => false
]);
