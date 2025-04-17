<?php

use App\Http\Controllers\AcademicInformationController;
use App\Http\Controllers\Admin\AttachmentApplicationsController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AttachmentApplicationController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\AttachmentPostingController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\StudentDocumentController;


Route::get('/', [GuestController::class, 'welcome'])->name('welcome');
Route::get('/attachments', [GuestController::class, 'attachments'])->name('attachments');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {



    Route::get('/attachment-application/{id?}', [AttachmentApplicationController::class, 'index'])->name('attachment-application');


    // Routes for Admin only
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin');
        Route::get('/students', [StudentsController::class, 'index'])->name('students.index');

        Route::get('/admin/attachments', [AttachmentController::class, 'index'])->name('attachments.index');
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

    Route::group(['middleware' => ['role:Admin|Organization|Institution']], function () {
        Route::get('/attachment/applications', [AttachmentApplicationsController::class, 'index'])->name('attachment.applications');


    });

// 1, 1, 1, 1







    Route::get('/notifications', function () {
        return view('pages.notifications');
    })->name('notifications');
    Route::get('/settings', function () {
        return view('pages.settings');
    })->name('settings');


    Route::resource('organizations', OrganizationController::class);
    Route::delete('organizations/{organization}', [OrganizationController::class, 'destroy'])->name('organizations.destroy');
    Route::put('organizations/{organization}', [OrganizationController::class, 'update'])->name('organizations.update');



    Route::get('attachment-posting', [AttachmentPostingController::class, 'index'])->name('attachment-posting');

    Route::post('attachment-posting', [AttachmentApplicationController::class, 'store'])->name('student.attachments.apply');
});
