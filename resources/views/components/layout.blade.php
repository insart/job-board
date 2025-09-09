<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="mx-auto mt-10 max-w-2xl bg-radial-[at_50%_75%] from-sky-200 via-blue-200 to-indigo-300 to-90% text-slate-900 w-full h-screen bg-fixed">
<nav class="mb-8 flex justify-between items-center text-lg font-medium">
    <ul class="flex gap-4">
        <li>
            <a href="{{ route('home') }}">Home</a>
        </li>
    </ul>
    <ul class="flex gap-4">
        @auth
            <li>
                <a href="{{ route('my-applications.index') }}">
                    {{ auth()->user()->name ?? 'UserName' }}: Applications
                </a>
            </li>
            <li>|</li>
            <li>
                <a href="{{ route('my-jobs.index') }}">
                    My Jobs
                </a>
            </li>
            <li>|</li>
            <li>
                <form action="{{ route('auth.destroy') }}" method="POST" class="">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Logout</button>
                </form>
            </li>
        @else
            <li>
                <a href="{{ route('login') }}">Login</a>
            </li>
        @endauth
    </ul>
</nav>
@if(session('success'))
    <div role="alert" class="my-8 rounded-md bg-green-200 p-4 text-green-700 bg-opacity-50 border-l-4 border-green-700">
        <p class="font-medium">Success!</p>
        <p>{{ session('success') }}</p>
    </div>
@elseif(session('error'))
    <div role="alert" class="my-8 rounded-md bg-red-200 p-4 text-red-700 bg-opacity-50 border-l-4 border-red-700">
        <p class="font-medium">Error!</p>
        <p>{{ session('error') }}</p>
    </div>
@endif
{{ $slot }}
</body>
</html>
