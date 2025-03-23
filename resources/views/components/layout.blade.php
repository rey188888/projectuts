<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Default Title')</title>
    <!-- Load Tailwind CSS -->
    @vite('resources/css/app.css')
    <!-- Load JavaScript -->
    @vite('resources/js/app.js')

</head>

<body class="bg-gray-100 min-h-screen">
    <!-- Include SweetAlert Component -->
    @include('components.sweetalerts')
    <!-- Include Sidebar -->
    @include('components.sidebar')

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>
