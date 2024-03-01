<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AuthController::class, 'login'])->name('login.show');
Route::post('/login', [AuthController::class, 'AuthLogin'])->name('login.perform');
Route::get('/logout', [AuthController::class, 'AuthLogout'])->name('logout');
Route::get('/forget-password', [AuthController::class, 'forgetPasswordShow'])->name('forget-password.show');
Route::post('/forget-password', [AuthController::class, 'forgetPasswordPerform'])->name('forget-password.perform');
Route::get('/reset/{token}', [AuthController::class, 'reset']);
Route::post('/reset/{token}', [AuthController::class, 'PostReset'])->name('reset');


Route::group(['middleware' => 'admin'], function(){
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/admin/list', [AdminController::class, 'list'])->name('admin.admin.list');
    Route::get('admin/admin/add', [AdminController::class, 'add'])->name('admin.admin.add.show');
    Route::post('admin/admin/add', [AdminController::class, 'insert'])->name('admin.admin.add.perform');
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/update/{admin}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{admin}', [AdminController::class, 'destroy']);

}); 
Route::group(['middleware' => 'teacher'], function(){
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard'])->name('teacher.dashboard');
    
}); 
Route::group(['middleware' => 'student'], function(){
    Route::get('student/dashboard', [DashboardController::class, 'dashboard'])->name('student.dashboard');
    
}); 
Route::group(['middleware' => 'parent'], function(){
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard'])->name('parent.dashboard');
    
}); 