<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobVacancyRequest;
use App\Models\JobVacancy;
use Auth;
use Gate;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('view-any-by-employer', JobVacancy::class);

        return view('my-jobs.index', [
            'jobVacancies' => auth()->user()->employer->jobVacancies()
                ->with(['employer', 'jobApplications', 'jobApplications.user'])
                ->latest()
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', JobVacancy::class);

        return view('my-jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobVacancyRequest $request)
    {
        Gate::authorize('create', JobVacancy::class);
        $validated = $request->validated();

        Auth::user()
            ->employer
            ->jobVacancies()
            ->create($validated);

        return redirect()
            ->route('my-jobs.index')
            ->with('success', 'Job vacancy created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobVacancy $myJob)
    {
        Gate::authorize('update', $myJob);

        return view('my-jobs.edit', ['jobVacancy' => $myJob]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobVacancyRequest $request, JobVacancy $myJob)
    {
        Gate::authorize('update', $myJob);
        $validated = $request->validated();
        $myJob->update($validated);

        return redirect()
            ->route('my-jobs.index')
            ->with('success', 'Job vacancy updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobVacancy $myJob)
    {
        $myJob->delete();

        return redirect()
            ->route('my-jobs.index')
            ->with('success', 'Job vacancy deleted successfully.');
    }
}
