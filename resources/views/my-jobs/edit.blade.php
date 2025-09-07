@php use App\Models\JobVacancy; @endphp
<x-layout>
    <x-breadcrumbs :breadcrumbs="[
        'My Jobs' => route('my-jobs.store'),
        'Edit' => '#'
    ]" class="mb-2"/>
    <x-card class="mb-8">
        <form action="{{ route('my-jobs.update', $jobVacancy) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <x-label for="title" label="Job Title" :required="true"/>
                    <x-text-input name="title" placeholder="Title" :value="$jobVacancy->title"/>
                </div>
                <div>
                    <x-label for="location" label="Location" :required="true"/>
                    <x-text-input name="location" placeholder="Location" :value="$jobVacancy->location"/>
                </div>
                <div>
                    <x-label for="salary" label="Salary" :required="true"/>
                    <x-text-input type="number" name="salary" placeholder="Salary" :value="$jobVacancy->salary"/>
                </div>
                <div>
                    <x-label for="category" label="Category" :required="true"/>
                    <x-select name="category" :options="JobVacancy::$categories" :selected="$jobVacancy->category"/>
                </div>
                <div>
                    <x-label for="level" label="Level" :required="true"/>
                    <x-select name="level" :options="JobVacancy::$levels" :selected="$jobVacancy->level"/>
                </div>
                <div class="col-span-2">
                    <x-label for="description" label="Description" :required="true"/>
                    <x-text-input type="textarea" name="description" placeholder="Job description..." :value="$jobVacancy->description"/>
                </div>
                <div class="col-span-2">
                    <x-label for="status" label="Status" :required="true"/>
                    <x-radio-group name="status"
                                   :options="JobVacancy::$statuses"
                                   :selected="$jobVacancy->status"
                                   :all="false"
                    />
                </div>
                <x-button type="submit" class="col-span-2">Update</x-button>
            </div>
        </form>
    </x-card>
</x-layout>
