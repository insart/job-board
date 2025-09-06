<x-layout>
    <x-card>
        <form action="{{ route('employers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <x-label for="name" label="Company Name" :required="true"/>
                <x-text-input type="text" name="name" required placeholder="Company Name"/>
            </div>
            <div class="mb-3">
                <x-label for="email" label="Email" :required="true"/>
                <x-text-input type="email" class="form-control" name="email" required placeholder="name@example.com"/>
            </div>
            <div class="mb-3">
                <x-label for="phone" label="Phone" :required="true"/>
                <x-text-input type="tel" class="form-control" name="phone" required placeholder="0123456789"/>
            </div>
            <div class="mb-3">
                <x-label for="address" label="Address" :required="true"/>
                <x-text-input type="text" class="form-control" name="address" required placeholder="Company Address"/>
            </div>
            <div class="mb-3">
                <x-label for="website" label="Website"/>
                <x-text-input type="text" class="form-control" name="website" placeholder="https://example.com"/>
            </div>
            <div class="mb-3">
                <x-label for="logo" label="Logo"/>
                <x-text-input type="file" class="form-control" name="logo"/>
            </div>
            <div class="mb-3">
                <x-label for="description" label="Description"/>
                <x-text-input type="textarea" rows="5" name="description" placeholder="Company Description"/>
            </div>
            <x-button class="w-full">Create</x-button>
        </form>
    </x-card>
</x-layout>