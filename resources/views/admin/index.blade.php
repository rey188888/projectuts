<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Welcome, {{ auth()->user()->role }}!</h1>
            <x-logout-button />
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <p>This is your dashboard.</p>
        </div>

    </div>
</body>

</html>
