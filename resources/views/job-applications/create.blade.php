<x-layout>
    <x-breadcrumbs class="mb-4" :breadcrumbs="[
    'Jobs' => route('job-vacancies.index'),
    $jobVacancy->title => route('job-vacancies.show', $jobVacancy->id),
    'Apply' => '#',
    ]"/>
    <x-job-card :job-vacancy="$jobVacancy"/>
    <x-card>
        <h2 class="mb4 text-lg font-medium">
            Your Job Application
        </h2>

        <form action="{{ route('job-vacancies.application.store', $jobVacancy) }}"
              method="POST"
              enctype="multipart/form-data"
        >
            @csrf
            <div class="mb-4">
                <x-label for="cover_letter" label="Cover Letter" :required="true"/>
                <x-text-input rows="10" type="textarea" name="cover_letter" placeholder="Write a short cover letter..."></x-text-input>
            </div>
            <div class="mb-4">
                <x-label for="resume" label="Resume" :required="true"/>
                <x-text-input type="file" required name="resume" required placehoder="Upload Resume"/>
            </div>
            <div class="mb-4">
                <x-label for="expected_salary" label="Expected Salary" :required="true"/>
                <x-text-input type="number" required id="expected_salary" name="expected_salary" placeholder="Enter Expected Salary"/>
            </div>
            <div class="flex justify-end">
                <x-button class="w-full">
                    Submit Application
                </x-button>
            </div>
        </form>
    </x-card>
</x-layout>