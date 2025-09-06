<x-layout>
    <x-breadcrumbs class="mb-4" :breadcrumbs="[
    'My Applications' => '#',
    ]"/>
    @forelse($jobApplications as $jobApplication)
        <x-job-card :job-vacancy="$jobApplication->jobVacancy">
            <div class="flex justify-between items-center text-xs text-gray-500">
                <div>
                    <div class="flex items-center gap-2">
                        Applied {{ $jobApplication->created_at->diffForHumans() }}
                    </div>
                    <div>
                        {{ $jobApplication->jobVacancy->job_applications_count -1 }}
                        other {{ Str::plural('applicant', $jobApplication->jobVacancy->job_applications_count -1) }}
                    </div>
                    <div>
                        Your asking salary is {{ $jobApplication->jobVacancy->salary }}
                    </div>
                    <div>
                        Average salary is ${{ (int)$jobApplication->jobVacancy->job_applications_avg_expected_salary }}
                    </div>
                </div>
                <div>
                    <form action="{{ route('my-applications.destroy', $jobApplication) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button>Cancel</x-button>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="rounded-md border border-dotted border-gray-500 p-8">
            <div class="text-center font-bold text-gray-500">
                You have not applied to any job yet!
            </div>
            <div class="text-center">
                Try searching for a job <a class="text-blue-700" href="{{ route('job-vacancies.index') }}">here!</a>
            </div>
        </div>
    @endforelse
</x-layout>