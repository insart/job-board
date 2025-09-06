@php use App\Models\JobVacancy; @endphp
<x-layout>
    <x-breadcrumbs :breadcrumbs="[
        'My Jobs' => route('my-jobs.store'),
        'Create' => '#'
    ]" class="mb-2"/>
    <x-card class="mb-8">
        <form action="{{ route('my-jobs.store') }}" method="POST">
            @csrf
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <x-label for="title" label="Job Title" :required="true"/>
                    <x-text-input name="title" placeholder="Title"/>
                </div>
                <div>
                    <x-label for="location" label="Location" :required="true"/>
                    <x-text-input name="location" placeholder="Location"/>
                </div>
                <div>
                    <x-label for="salary" label="Salary" :required="true"/>
                    <x-text-input type="number" name="salary" placeholder="Salary"/>
                </div>
                <div>
                    <x-label for="category" label="Category" :required="true"/>
                    <x-select name="category" :options="JobVacancy::$categories"/>
                </div>
                <div>
                    <x-label for="level" label="Level" :required="true"/>
                    <x-select name="level" :options="JobVacancy::$levels"/>
                </div>
                <div class="col-span-2">
                    <x-label for="description" label="Description" :required="true"/>
                    <x-text-input type="textarea" name="description" placeholder="Job description..."/>
                </div>
                <x-button type="submit" class="col-span-2">Create</x-button>
            </div>
        </form>
    </x-card>
</x-layout>

* @property string $level
* @property string $status