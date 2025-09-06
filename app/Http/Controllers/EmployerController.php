<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Auth;
use Gate;
use Illuminate\Http\Request;

class EmployerController extends Controller
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
    public function create()
    {
        Gate::authorize('create', Employer::class);

        return view('employers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Auth::user()->employer()->create([
            ...$request->validate([
                'name' => 'required|string|max:255|min:3',
                'email' => 'required|email|unique:employers',
                'address' => 'required|string|max:255',
                'phone' => 'required|unique:employers',
                'website' => 'string|nullable',
                'description' => 'string|nullable',
            ]),
        ]);

        return redirect()->route('job-vacancies.index')->with('success', 'Employer created successfully.');
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
    public function destroy(string $id)
    {
        //
    }
}
