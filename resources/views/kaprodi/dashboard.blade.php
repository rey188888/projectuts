@extends('components.layout')

@section('title')
    Dashboard Kaprodi
@endsection

@section('content')
<body class="bg-gray-100 min-h-screen">
    <div class="flex min-h-screen bg-gray-100">
        @include('components.sidebar')

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <div class="container mx-auto p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6 bg-white p-4 rounded-lg shadow-md">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Kaprodi</h1>
                </div>

                <!-- Content -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <p class="mb-6">Selamat datang, {{ auth()->user()->role }}! Ini adalah data surat yang anda terima.</p>

                    <!-- Statistik Pengajuan Surat -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <!-- Card Disetujui -->
                        <div class="bg-green-100 p-4 rounded-lg shadow-sm flex items-center">
                            <svg class="w-8 h-8 text-green-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Disetujui</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $disetujui }}</p>
                            </div>
                        </div>

                        <!-- Card Ditolak -->
                        <div class="bg-red-100 p-4 rounded-lg shadow-sm flex items-center">
                            <svg class="w-8 h-8 text-red-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Ditolak</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $ditolak }}</p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection