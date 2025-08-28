<x-layout>
<x-breadcrumbs class="mb-4" :jobVacancy="$jobVacancy" :breadcrumbs="[
    'Vacancies' => route('job-vacancies.index'),
    $jobVacancy->title => '#',
    ]"/>
    <x-job-card class="mb-4" :$jobVacancy>
        <p class="text-sm text-gray-500 mb-4 mt-4">{!! nl2br(e($jobVacancy->description)) !!}</p>
    </x-job-card>
</x-layout>

