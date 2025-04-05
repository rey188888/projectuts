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
                    <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                        <h2 class="text-2xl text-gray-800">Silakan pilih form yang akan diajukan:</h2>
                        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                            <div class="grid grid-cols-4 gap-4">
                                <!-- Card 1 -->
                                <a href="/student/pengajuan/template_mhs_aktif"
                                    class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                    <div class="p-4 flex justify-center">
                                        <img src="/asset/letter.png" alt="Surat Keterangan Mahasiswa Aktif"
                                            class="w-32 h-64     object-contain">
                                    </div>
                                    <div class="p-6 text-center flex flex-col justify-center">
                                        <h3 class="text-xl font-semibold text-gray-900">Surat Keterangan Mahasiswa Aktif
                                        </h3>
                                    </div>
                                </a>

                                <!-- Card 2 -->
                                <a href="/student/pengajuan/template_pengantar_tugasmk"
                                    class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                    <div class="p-4 flex justify-center">
                                        <img src="/asset/letter.png" alt="Surat Pengantar Tugas Mata Kuliah"
                                            class="w-32 h-64 object-contain">
                                    </div>
                                    <div class="p-6 text-center flex flex-col justify-center">
                                        <h3 class="text-xl font-semibold text-gray-900">Surat Pengantar Tugas Mata Kuliah
                                        </h3>
                                    </div>
                                </a>

                                <!-- Card 3 -->
                                <a href="/student/pengajuan/template_ket_lulus"
                                    class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                    <div class="p-4 flex justify-center">
                                        <img src="/asset/letter.png" alt="Surat Keterangan Lulus"
                                            class="w-32 h-64 object-contain">
                                    </div>
                                    <div class="p-6 text-center flex flex-col justify-center">
                                        <h3 class="text-xl font-semibold text-gray-900">Surat Keterangan Lulus</h3>
                                    </div>
                                </a>

                                <!-- Card 4 -->
                                <a href="/student/pengajuan/template_laporan_studi"
                                    class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                    <div class="p-4 flex justify-center">
                                        <img src="/asset/letter.png" alt="Surat Laporan Hasil Studi"
                                            class="w-32 h-64 object-contain">
                                    </div>
                                    <div class="p-6 text-center flex flex-col justify-center">
                                        <h3 class="text-xl font-semibold text-gray-900">Surat Laporan Hasil Studi</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
