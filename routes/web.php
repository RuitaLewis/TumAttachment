<?php

use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::group(['middleware' => ['role:Admin']], function () {
        // Routes for Admin only
        Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin');

    });


    Route::get('/student-profile', function () {
        return view('pages.student-profile');
    })->name('student-profile');



    Route::get('/attachment-application', function () {
        return view('student.application-portal');
    })->name(
        'attachment-application'
    );




    Route::get('/notifications', function () {
        return view('pages.notifications');
    })->name('notifications');
    Route::get('/settings', function () {
        return view('pages.settings');
    })->name('settings');


    // Route::resource('organizations', OrganizationController::class);
    Route::get('organizations', [OrganizationController::class, 'index'])->name('organizations');
    Route::delete('organizations/{organization}', [OrganizationController::class, 'destroy'])->name('organizations.destroy');
    Route::put('organizations/{organization}', [OrganizationController::class, 'update'])->name('organizations.update');


    Route::get('/applications', function () {
        return view('pages.applications');
    })->name('applications');

    Route::get('/attachment-posting', function () {
        return view('pages.attachment-posting');
    })->name('attachment-posting');
});
