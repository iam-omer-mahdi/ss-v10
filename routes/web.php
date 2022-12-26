<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\StudentPartController;
use App\Http\Controllers\TransportationController;
use App\Http\Controllers\StudentTransportationPartController;

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
    // Classes
    Route::resource('class', ClassroomController::class);
    Route::get('create_result', [ResultController::class, 'create_result'])->name('create_result');
    Route::post('create_result', [ResultController::class, 'store_result'])->name('store_result');
    // Students
    Route::resource('student', StudentController::class);
    Route::post('student/search', [StudentController::class, 'search'])->name('student.search');
    Route::get('student/create_result/{id}', [StudentController::class, 'create_result'])->name('student.create_result');
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
    Route::post('report/get_exams', [ReportController::class, 'getExams'])->name('report.getExams');

    // Manage Users
    Route::resource('user', UserController::class);
    Route::get('user/change_password/{id}', [UserController::class, 'change_password'])->name('user.change_password');
    Route::put('user/change_password/{id}', [UserController::class, 'update_password'])->name('user.update_password');
    // Exam
    Route::resource('exam', ExamController::class);
    // Subject
    Route::resource('subject', SubjectController::class);
    // Result
    Route::resource('result', ResultController::class);
    Route::post('result/get_subjects', [ResultController::class, 'get_subjects'])->name('result.get_subjects');    
    Route::get('result_report', [ResultController::class, 'result_report'])->name('result.result_report');    
    // Transportation
    Route::get('transportation/add_students/{id}', [TransportationController::class, 'add_students'])->name('transportation.add_students');
    Route::post('transportation/add_students', [TransportationController::class,'store_students'])->name('transportation.store_students');
    Route::delete('transportation/add_students/{id}', [TransportationController::class,'destroy_students'])->name('transportation.destroy_students');
    Route::resource('transportation', TransportationController::class);
    Route::post('transportation_part/store_part', [StudentTransportationPartController::class, 'store_part'])->name('store_part');
    Route::put('transportation_part/update_part/{id}', [StudentTransportationPartController::class, 'update_part'])->name('update_part');
    Route::resource('transportation_part', StudentTransportationPartController::class);
});

