<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Gate;

class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('view-any', JobVacancy::class);

        return view('job-vacancies.index', [
            'jobVacancies' => JobVacancy::search()
                ->with('employer')
                ->get(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobVacancy $jobVacancy)
    {
        Gate::authorize('view', $jobVacancy);

        return view(
            'job-vacancies.show', [
                'jobVacancy' => $jobVacancy->load('employer.jobVacancies'),
            ]
        );
    }
}
