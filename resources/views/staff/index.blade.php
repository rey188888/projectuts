@extends('components.layout')

@section('title')
    Home
@endsection

@section('content')
<body class="bg-gray-100 min-h-screen">
    <div class="flex min-h-screen bg-gray-100"> <!-- Main flex container -->
        @include('components.sidebar')

        @yield('content')

        <!-- Main Content -->
        <div class="flex-1 ml-64"> <!-- Offset for sidebar width -->
            <div class="container mx-auto p-6">
                <!-- Welcome Container -->
                <div class="flex justify-between items-center mb-6 bg-white p-4 rounded-lg shadow-md">
                    <h1 class="text-2xl font-bold text-gray-800">Welcome, {{ auth()->user()->role }}!</h1>
                    <!-- Logout button removed from here -->
                </div>

                <!-- Additional content -->
                
                
            </div>
        </div>
    </div>
</body>

</html>