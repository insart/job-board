<?php

use App\Http\Controllers\JobVacancyController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => to_route('job-vacancies.index'));

Route::resource('job-vacancies', JobVacancyController::class)
->only(['index', 'show']);
