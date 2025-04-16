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

                    <!-- Statistik Pengajuan Surat - Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
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

                        <!-- Card Menunggu Persetujuan -->
                        <div class="bg-yellow-100 p-4 rounded-lg shadow-sm flex items-center">
                            <svg class="w-8 h-8 text-yellow-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Menunggu Persetujuan</h3>
                                <p class="text-2xl font-bold text-gray-900">{{ $pendingCount }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Visualisasi Status Pengajuan Surat</h2>
                        <div style="height: 400px;">
                            <canvas id="applicationPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('applicationPieChart').getContext('2d');
            
            // Data for the pie chart
            const data = {
                labels: ['Menunggu Persetujuan', 'Disetujui', 'Ditolak'],
                datasets: [{
                    data: [{{ $pendingCount }}, {{ $disetujui }}, {{ $ditolak }}],
                    backgroundColor: [
                        '#FBBF24', // Yellow for pending
                        '#34D399', // Green for approved
                        '#F87171'  // Red for rejected
                    ],
                    borderColor: [
                        '#F59E0B',
                        '#10B981', 
                        '#EF4444'
                    ],
                    borderWidth: 1
                }]
            };
            
            // Configuration options
            const config = {
                type: 'pie',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                font: {
                                    size: 14
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((acc, data) => acc + data, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            };
            
            // Create the pie chart
            new Chart(ctx, config);
        });
    </script>
</body>
@endsection