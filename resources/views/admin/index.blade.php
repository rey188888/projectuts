@extends('components.layout')

@section('title')
    Admin Dashboard
@endsection

@section('content')
<body class="bg-gray-100 min-h-screen">
    <div class="flex min-h-screen bg-gray-100">
        @include('components.sidebar') {{-- Sidebar Component --}}

        <div class="flex-1 ml-64">
            <div class="container mx-auto p-6">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Akun Baru</h2>
                    <div class="grid grid-cols-3 gap-6">

                        <!-- Mahasiswa Card -->
                        <a href="{{ route('admin.create.mahasiswa') }}"
                           class="bg-blue-100 border border-blue-300 p-6 rounded-lg shadow-md hover:shadow-xl transition-transform transform hover:scale-105 text-center">
                            <h3 class="text-xl font-semibold text-blue-800">Tambah Mahasiswa</h3>
                        </a>

                        <!-- Staff Card -->
                        <a href="{{ route('admin.create.staff') }}"
                           class="bg-green-100 border border-green-300 p-6 rounded-lg shadow-md hover:shadow-xl transition-transform transform hover:scale-105 text-center">
                            <h3 class="text-xl font-semibold text-green-800">Tambah Staff</h3>
                        </a>

                        <!-- Kaprodi Card -->
                        <a href="{{ route('admin.create.kaprodi') }}"
                           class="bg-yellow-100 border border-yellow-300 p-6 rounded-lg shadow-md hover:shadow-xl transition-transform transform hover:scale-105 text-center">
                            <h3 class="text-xl font-semibold text-yellow-800">Tambah Kaprodi</h3>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
