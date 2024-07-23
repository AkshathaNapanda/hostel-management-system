<?php

use Illuminate\Support\Facades\Route;

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

// landing
Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
// auth
Auth::routes();
// home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// admissions
Route::resource('admissions', App\Http\Controllers\Web\AdmissionsController::class);
Route::get('/admissions/custom/search', [App\Http\Controllers\Web\AdmissionsController::class, 'search'])->name('admissions.search');
Route::get('/admissions/custom/admission-status/{admission}/update', [App\Http\Controllers\Web\AdmissionsController::class, 'updateAdmissionStatus'])->name('admissions.update.admission-status');
// attendance sessions
// Route::resource('attendance-sessions', App\Http\Controllers\Web\AttendanceSessionsController::class);
Route::get('/attendance-sessions', [App\Http\Controllers\Web\AttendanceSessionsController::class, 'index'])->name('attendance-sessions.index');
Route::get('/attendance-sessions/{attendance_session}', [App\Http\Controllers\Web\AttendanceSessionsController::class, 'show'])->name('attendance-sessions.show');
Route::get('/attendance-sessions/custom/begin', [App\Http\Controllers\Web\AttendanceSessionsController::class, 'begin'])->name('attendance-sessions.begin');
Route::get('/attendance-sessions/custom/current', [App\Http\Controllers\Web\AttendanceSessionsController::class, 'current'])->name('attendance-sessions.current');
Route::put('/attendance-sessions/custom/end', [App\Http\Controllers\Web\AttendanceSessionsController::class, 'end'])->name('attendance-sessions.end');
// attendances
Route::resource('attendances', App\Http\Controllers\Web\AttendancesController::class);
Route::get('/attendances/custom/present/{attendance}/update', [App\Http\Controllers\Web\AttendancesController::class, 'updatePresent'])->name('attendances.update.present');
Route::get('/attendances/custom/absent/{attendance}/update', [App\Http\Controllers\Web\AttendancesController::class, 'updateAbsent'])->name('attendances.update.absent');
// mess fees
Route::resource('mess-fees', App\Http\Controllers\Web\MessFeesController::class);
Route::get('/mess-fees/students/search', [App\Http\Controllers\Web\MessFeesController::class, 'searchStudents'])->name('mess-fees.students.search');
Route::get('/mess-fees/fee-status/{mess_fee}/update', [App\Http\Controllers\Web\MessFeesController::class, 'updateFeeStatus'])->name('mess-fees.update.fee-status');
// repositories
Route::resource('repositories', App\Http\Controllers\Web\RepositoriesController::class);
Route::get('/repositories/students/search', [App\Http\Controllers\Web\RepositoriesController::class, 'searchStudents'])->name('repositories.students.search');
Route::get('/repositories/repository-status/{repository}/update', [App\Http\Controllers\Web\RepositoriesController::class, 'updateRepositoryStatus'])->name('repositories.update.repository-status');
