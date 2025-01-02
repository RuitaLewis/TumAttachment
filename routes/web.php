<?php

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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');




    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
    Route::get('/student-profile', function () {
        return view('pages.student-profile');
    });



    Route::get('/attachment-application', function () {
        return view('student.application-portal');
    });


    

    Route::get('/notifications', function () {
        return view('pages.notifications');
    });
    Route::get('/settings', function () {
        return view('pages.settings');
    });


    Route::resource('organizations', OrganizationController::class);
    Route::delete('organizations/{organization}', [OrganizationController::class, 'destroy'])->name('organizations.destroy');
    Route::put('organizations/{organization}', [OrganizationController::class, 'update'])->name('organizations.update');


    Route::get('/applications', function () {
        return view('pages.applications');
    });
    Route::get('/attachment-posting', function () {
        return view('pages.attachment-posting');
    });
});
