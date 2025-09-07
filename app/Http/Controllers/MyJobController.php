<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('my-jobs.index', [
            'jobVacancies' => auth()->user()->employer->jobVacancies()
                ->with(['employer', 'jobApplications', 'jobApplications.user'])
                ->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('my-jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|numeric|min:1000|max:1000000',
            'location' => 'required|string',
            'level' => [
                'required',
                Rule::in(JobVacancy::$levels),
            ],
            'category' => [
                'required',
                Rule::in(JobVacancy::$categories),
            ],
        ]);

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
        return view('my-jobs.edit', ['jobVacancy' => $myJob]);
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
    public function destroy(string $id)
    {
        //
    }
}
