<x-layout>
    <x-breadcrumbs
            :breadcrumbs="[
                'My Jobs' => route('my-jobs.store'),
            ]"
            class="mb-2"
    />
    <div class="mb-6 text-right">
        <x-link-button href="{{ route('my-jobs.create') }}">Add New</x-link-button>
    </div>
    @forelse($jobVacancies as $jobVacancy)
        <x-job-card :job-vacancy="$jobVacancy">
            <div class="text-sm text-gray-400 mt-4">
                @forelse($jobVacancy->jobApplications as $application)
                    <div class="flex items-center mb-4 justify-between">
                        <div>
                            <div>
                                {{ $application->user->name }}
                            </div>
                            <div>
                                Applied on {{ $application->created_at->format('d M Y') }}
                            </div>
                            <div>
                                Download resume: <a href="{{ $application->resume_url }}" class="underline">Download</a>
                            </div>
                        </div>
                        <div>
                            <div>
                                ${{ number_format($application->expected_salary) }}
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="text-gray-400 mb-4">
                        No applications yet.
                    </div>
                @endforelse
                <div class="flex space-x-2">
                    <x-link-button href="{{ route('my-jobs.edit', $jobVacancy) }}">
                        Edit
                    </x-link-button>
                    <form action="{{ route('my-jobs.destroy', $jobVacancy) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button class="text-red-700">Delete</x-button>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="rounded-md border border-dotted border-gray-500 p-8">
            <div class="text-center font-bold text-gray-500">
                No jobs posted yet.
            </div>
            <div class="text-center">
                Create a new job to get started by clicking the button below.
            </div>
            <div class="text-center mt-4">
                <x-link-button href="{{ route('my-jobs.create') }}">Add New</x-link-button>
            </div>
        </div>
    @endforelse
</x-layout>