<?php

use App\Http\Controllers\AcademicInformationController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\AttachmentPostingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\StudentDocumentController;

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

        Route::get('/attachments', [AttachmentController::class, 'index'])->name('attachments.index');
        Route::post('/attachments', [AttachmentController::class, 'store'])->name('attachments.store');
        Route::put('/attachments/{attachment}', [AttachmentController::class, 'update'])->name('attachments.update');
        Route::delete('/attachments/{attachment}', [AttachmentController::class, 'destroy'])->name('attachments.destroy');


        Route::post('/positions', [PositionController::class, 'store'])->name('positions.store');
    });

    // Routes for Admin & Student
    Route::group(['middleware' => ['role:Admin|Student']], function () {
        Route::get('/student-profile', [StudentController::class, 'index'])->name('student-profile');
        Route::put('/personal-info/{user}', [App\Http\Controllers\UserPersonalInfoController::class, 'update'])->name('personal-info.update');
        Route::post('/academic/update/{id}', [AcademicInformationController::class, 'update'])->name('academic.update');

        Route::post('/documents/upload/{id}', [StudentDocumentController::class, 'store'])->name('document.upload');
        Route::get('/documents/download/{id}', [StudentDocumentController::class, 'download'])->name('document.download');
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

    Route::get('attachment-posting', [AttachmentPostingController::class, 'index'])->name('attachment-posting');
});
