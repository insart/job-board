<x-layout>
    <x-breadcrumbs class="mb-4" :jobVacancy="$jobVacancy" :breadcrumbs="[
    'Jobs' => route('job-vacancies.index'),
    $jobVacancy->title => '#',
    ]"/>
    <x-job-card class="mb-4" :$jobVacancy>
        <p class="text-sm text-gray-500 mb-4 mt-4">
            {!! nl2br(e($jobVacancy->description)) !!}
        </p>
        @can('apply', $jobVacancy)
            <x-link-button :href="route('job-vacancies.application.create', $jobVacancy)" class="mt-4">
                Apply
            </x-link-button>
        @else
            <div class="mt-4 text-center font-medium text-sm text-blue-500">
                You have already applied to this job or period for application has expired.
            </div>
        @endcan
    </x-job-card>

    <x-card class="mb-4">
        <h2 class="text-lg font-semibold mb-4">
            More from {{ $jobVacancy->employer->name }}
        </h2>
        <div class="text-sm text-gray-500 mb-4">
            @foreach ($jobVacancy->employer->jobVacancies as $vacancy)
                <div class="mb-2 flex justify-between">
                    <div>
                        <div class="font-semibold text-blue-700">
                            <a href="{{ route('job-vacancies.show', $vacancy) }}">
                                {{ $vacancy->title }}
                            </a>
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $vacancy->location }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ $vacancy->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div>
                        ${{ number_format($vacancy->salary) }}
                    </div>
                </div>
            @endforeach
        </div>
    </x-card>
</x-layout>

