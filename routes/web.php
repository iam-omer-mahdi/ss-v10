<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
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
    // Grades
    Route::resource('grade', GradeController::class);
    Route::get('grade/getGrades/{id}', [GradeController::class, 'getGrades'])->name('getGrades');
    Route::resource('class', ClassroomController::class);
    // Students
    Route::resource('student', StudentController::class);
    Route::post('student/search', [StudentController::class, 'search'])->name('student.search');
    Route::get('student/create_result/{id}', [StudentController::class, 'create_result'])->name('student.create_result');
    Route::post('student/create_result', [StudentController::class, 'store_result'])->name('student.store_result');
    Route::get('student/show_result/{id}', [StudentController::class, 'show_result'])->name('student.show_result');
    // Discounts
    Route::resource('discount', DiscountController::class);
    // Fees
    Route::resource('fee', FeeController::class);
    // Students Payment Parts
    Route::resource('part', StudentPartController::class);
    Route::get('part/payment/{id}', [StudentPartController::class, 'paymentPage'])->name('part.paymentPage');
    Route::put('part/pay/{id}', [StudentPartController::class, 'pay'])->name('part.pay');
    Route::get('part/receipt/{id}', [StudentPartController::class, 'receipt'])->name('part.receipt');
    // School Reports
    Route::get('report', [ReportController::class, 'index'])->name('report.index');
    Route::post('report', [ReportController::class, 'report'])->name('report.report');
    Route::post('report/get_grades', [ReportController::class, 'getGrades'])->name('report.getGrades');
    Route::post('report/get_classes', [ReportController::class, 'getClasses'])->name('report.getClasses');
    // Manage Users
    Route::resource('user', UserController::class);
    Route::get('user/change_password/{id}', [UserController::class, 'change_password'])->name('user.change_password');
    Route::put('user/change_password/{id}', [UserController::class, 'update_password'])->name('user.update_password');
    // Exam
    Route::resource('exam', ExamController::class);
    // Subject
    Route::resource('subject', SubjectController::class);
});

