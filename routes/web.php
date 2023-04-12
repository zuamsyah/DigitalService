<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TestimonialController;
use App\Models\Testimonial;

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

Route::get('/', [IndexController::class, 'index']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin');
        
        Route::get('/employee', [EmployeeController::class, 'index'])->name('admin.employee');
        Route::get('/employee/create', [EmployeeController::class, 'create'])->name('admin.employee.create');
        Route::post('/employee/create', [EmployeeController::class, 'store'])->name('admin.employee.store');
        Route::get('/employee/edit/{employee}', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
        Route::put('/employee/edit/{employee}', [EmployeeController::class, 'update'])->name('admin.employee.update');
        Route::delete('/employee/{employee}', [EmployeeController::class, 'destroy'])->name('admin.employee.delete');
        Route::get('/ajax/employee-datatable', [EmployeeController::class, 'datatable'])->name('admin.employee.datatable');

        Route::get('/testimonial', [TestimonialController::class, 'index'])->name('admin.testimonial');
        Route::get('/ajax/testimonial-datatable', [TestimonialController::class, 'datatable'])->name('admin.testimonial.datatable');
        Route::get('/testimonial/create', [TestimonialController::class, 'create'])->name('admin.testimonial.create');
        Route::post('/testimonial/create', [TestimonialController::class, 'store'])->name('admin.testimonial.store');
        Route::get('/testimonial/edit/{testimonial}', [TestimonialController::class, 'edit'])->name('admin.testimonial.edit');
        Route::put('/testimonial/edit/{testimonial}', [TestimonialController::class, 'update'])->name('admin.testimonial.update');
        Route::delete('/testimonial/{testimonial}', [TestimonialController::class, 'destroy'])->name('admin.testimonial.delete');

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});