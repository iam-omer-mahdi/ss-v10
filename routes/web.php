<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\StudentPartController;

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
    return view('auth.login');
})->middleware(['guest']);

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('school', SchoolController::class);
    Route::resource('grade', GradeController::class);
    Route::get('grade/getGrades/{id}', [GradeController::class, 'getGrades'])->name('getGrades');
    Route::resource('class', ClassroomController::class);
    Route::resource('student', StudentController::class);
    Route::post('student/search', [StudentController::class, 'search'])->name('student.search');
    Route::resource('discount', DiscountController::class);
    Route::resource('fee', FeeController::class);
    Route::resource('part', StudentPartController::class);
    Route::get('part/payment/{id}', [StudentPartController::class, 'paymentPage'])->name('part.paymentPage');
    Route::put('part/pay/{id}', [StudentPartController::class, 'pay'])->name('part.pay');
    Route::get('part/receipt/{id}', [StudentPartController::class, 'receipt'])->name('part.receipt');
    Route::get('report', [ReportController::class, 'index'])->name('report.index');
    Route::post('report', [ReportController::class, 'report'])->name('report.report');
});
