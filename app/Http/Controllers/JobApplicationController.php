<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(JobVacancy $jobVacancy)
    {
        Gate::authorize('apply', $jobVacancy);

        return view('job-applications.create', [
            'jobVacancy' => $jobVacancy,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobVacancy $jobVacancy, Request $request)
    {
        Gate::authorize('apply', $jobVacancy);

        $validatedData = $request->validate([
            'cover_letter' => 'required',
            'expected_salary' => 'required|numeric:integer|min:1000|max:1000000',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $file = $request->file('resume');
        $fileName = time().'_'.\Str::snake($file->getClientOriginalName());
        $file->storeAs('resumes', $fileName, 'private');
        $validatedData['resume'] = 'resumes/'.$fileName;

        $jobVacancy->jobApplications()->create([
            'user_id' => auth()->id(),
            ...$validatedData,
        ]);

        return redirect()
            ->route('job-vacancies.show', $jobVacancy)
            ->with('success', 'Application submitted successfully.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $jobApplication)
    {
        $jobApplication->delete();

        return redirect()->back()->with('success', 'Application deleted successfully.');
    }
}
