<x-card class="mb-4">
    <div class="mb-1 flex justify-between">
        <h2 class="text-lg font-semibold">
            {{ $jobVacancy->title }}
        </h2>
        <div class="text-sm text-gray-500">${{ number_format($jobVacancy->salary) }}</div>
    </div>
    <div class="mb-2 flex justify-between text-sm text-gray-500 items-center">
        <div class="flex space-x-4">
            <div>{{ $jobVacancy->employer->name }}</div>
            <div>{{ $jobVacancy->location }}</div>
        </div>
        <div class="flex space-x-1 text-xs">
            <x-tag>
                <a href="{{ route('job-vacancies.index', ['level' => $jobVacancy->level]) }}">
                    {{ Str::ucfirst($jobVacancy->level) }}
                </a>
            </x-tag>
            <x-tag>
                <a href="{{ route('job-vacancies.index', ['category' => $jobVacancy->category]) }}">
                    {{ Str::ucfirst($jobVacancy->category) }}
                </a>
            </x-tag>
            <x-tag>{{ Str::ucfirst($jobVacancy->status) }}</x-tag>
        </div>
    </div>

    {{ $slot }}
</x-card>