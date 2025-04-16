<?php

use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentsController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Routes for Admin only
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin');
        Route::get('/students', [StudentsController::class, 'index'])->name('students.index');
    });

    // Routes for Admin & Student
    Route::group(['middleware' => ['role:Admin|Student']], function () {
        Route::get('/student-profile', [StudentController::class, 'index'])->name('student-profile');
    });






    Route::get('/attachment-application', function () {
        return view('student.application-portal');
    })->name('attachment-application');




    Route::get('/notifications', function () {
        return view('pages.notifications');
    })->name('notifications');
    Route::get('/settings', function () {
        return view('pages.settings');
    })->name('settings');


    Route::resource('organizations', OrganizationController::class);
    Route::delete('organizations/{organization}', [OrganizationController::class, 'destroy'])->name('organizations.destroy');
    Route::put('organizations/{organization}', [OrganizationController::class, 'update'])->name('organizations.update');


    Route::get('/applications', function () {
        return view('pages.applications');
    })->name('applications');

    Route::get('/attachment-posting', function () {
        return view('pages.attachment-posting');
    })->name('attachment-posting');
});
