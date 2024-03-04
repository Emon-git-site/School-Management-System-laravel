<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\Class_subjectController;
use App\Http\Controllers\admin\ClassController;
use App\Http\Controllers\admin\SubjectController;

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

    // class route
    Route::get('admin/class/list', [ClassController::class, 'list'])->name('admin.class.list');
    Route::get('admin/class/add', [ClassController::class, 'add'])->name('admin.class.add.show');
    Route::post('admin/class/add', [ClassController::class, 'insert'])->name('admin.class.add.perform');
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('admin/class/update/{classe}', [ClassController::class, 'update']);
    Route::get('admin/class/delete/{classe}', [ClassController::class, 'destroy']);

    // subject route
    Route::get('admin/subject/list', [SubjectController::class, 'list'])->name('admin.subject.list');
    Route::get('admin/subject/add', [SubjectController::class, 'add'])->name('admin.subject.add.show');
    Route::post('admin/subject/add', [SubjectController::class, 'insert'])->name('admin.subject.add.perform');
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('admin/subject/update/{subject}', [SubjectController::class, 'update']);
    Route::get('admin/subject/delete/{subject}', [SubjectController::class, 'destroy']);

    // assign-subject route
    Route::get('admin/assign-subject/list', [Class_subjectController::class, 'list'])->name('admin.assign-subject.list');
    Route::get('admin/assign-subject/add', [Class_subjectController::class, 'add'])->name('admin.assign-subject.add.show');
    Route::post('admin/assign-subject/add', [Class_subjectController::class, 'insert'])->name('admin.assign-subject.add.perform');
    Route::get('admin/assign-subject/edit/{class_subject}', [Class_subjectController::class, 'edit']);
    Route::post('admin/assign-subject/update/{class_subject}', [Class_subjectController::class, 'update']);
    Route::get('admin/assign-subject/edit-single/{class_subject}', [Class_subjectController::class, 'editSingle']);
    Route::post('admin/assign-subject/update-single/{class_subject}', [Class_subjectController::class, 'updateSingle']);
    Route::get('admin/assign-subject/delete/{class_subject}', [Class_subjectController::class, 'destroy']);

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