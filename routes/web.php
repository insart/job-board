<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\MyJobApplicationController;
use App\Http\Controllers\MyJobController;
use Illuminate\Support\Facades\Route;

// # REDIRECTS
Route::get('/', fn () => to_route('job-vacancies.index'))
    ->name('home');
Route::get('login', fn () => to_route('auth.create'))
    ->name('login');
Route::delete('logout', fn () => to_route('auth.destroy', 'logout'))
    ->name('logout');

// # OPEN
Route::resource('job-vacancies', JobVacancyController::class)
    ->only(['index', 'show']);

// # AUTH
Route::resource('auth', AuthController::class)
    ->only(['create', 'store'])
    ->names('auth');
Route::delete('auth', [AuthController::class, 'destroy'])
    ->name('auth.destroy');

Route::middleware('auth')->group(function () {
    Route::resource('job-vacancies.application', JobApplicationController::class)
        ->only(['create', 'store', 'destroy']);

    Route::resource('my-applications', MyJobApplicationController::class)
        ->only(['index', 'show', 'destroy'])
        ->names('my-applications');

    Route::resource('employers', EmployerController::class)
        ->only(['create', 'store'])
        ->names('employers');

    Route::middleware('employer')
        ->resource('my-jobs', MyJobController::class)
        ->names('my-jobs');
});
