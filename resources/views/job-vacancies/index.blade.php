@php use App\Models\JobVacancy; @endphp
<x-layout>
    <x-breadcrumbs class="mb-4" :breadcrumbs="['Vacancies' => route('job-vacancies.index')]"/>
    <x-card class="mb-4 text-sm" x-data="">
        <form x-ref="search_form" id="search-form" action="{{ route('job-vacancies.index') }}" method="get">
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input name="search" placeholder="Job Title, Location..." class="col-span-2"
                                  value="{{ request('search') }}" form-ref="search-form"/>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex gap-4">
                        <x-text-input name="min_salary" placeholder="From" class="col-span-2"
                                      value="{{ request('min_salary') }}" form-ref="search-form"/>
                        <x-text-input name="max_salary" placeholder="To" class="col-span-2"
                                      value="{{ request('max_salary') }}" form-ref="search-form"/>
                    </div>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Level</div>
                    <x-radio-group name="level" class="col-span-2" :options="JobVacancy::$levels"
                                   :selected="request('level')"/>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Category</div>
                    <x-radio-group name="category" class="col-span-2" :options="JobVacancy::$categories"
                                   :selected="request('category')"/>
                </div>
                <x-button class="col-span-2" type="submit">
                    Search
                </x-button>
            </div>
        </form>
    </x-card>
    @foreach($jobVacancies as $jobVacancy)
        <x-job-card class="mb-4" :$jobVacancy>
            <div class="flex justify-between mt-4">
                <x-link-button :href="route('job-vacancies.show', $jobVacancy)">
                    View Job
                </x-link-button>
                {{--                <a href="{{ route('jobs.apply', $job) }}" class="text-blue-500 hover:underline">Apply Now</a>--}}
            </div>
        </x-job-card>
    @endforeach
</x-layout>