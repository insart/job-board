<x-layout>
    <h1 class="my-16 text-center text-4xl font-medium text-gray-600">
        Sign in to your account
    </h1>
    <x-card class="py-8 px-16">
        <form action="{{ route('auth.store') }}" method="POST">
            @csrf
            <div class="mb-8">
                <x-label for="email" label="Email"/>
                <x-text-input type="email" name="email"/>
            </div>
            <div class="mb-8">
                <x-label for="password" label="Password"/>
                <x-text-input type="password" name="password"/>
            </div>
            <div class="mb-8 flex justify-between text-sm font-medium text-gray-600">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <x-label for="remember" label="Remember me"/>
                </div>
                <div class="">
                    <a href="#" class="hover:underline">Forgot password?</a>
                </div>
            </div>
            <x-button class="w-full">Login</x-button>
        </form>
    </x-card>
</x-layout>