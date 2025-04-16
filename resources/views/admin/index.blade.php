@extends('components.layout')

@section('title')
    Dashboard Admin
@endsection

@section('content')

    <body class="bg-gray-100 min-h-screen">
        <div class="flex min-h-screen bg-gray-100">
            @include('components.sidebar') {{-- Sidebar Component --}}

            <div class="flex-1 ml-64">
                <div class="container mx-auto p-6">

                    <!-- Add Account Cards -->
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

                    <!-- User Counts Chart Card -->
                    <div class="bg-white p-6 rounded-lg shadow-lg mb-6 mt-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Statistik Pengguna</h2>
                        <div style="height: 300px;">
                            <canvas id="userChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include Chart.js library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

        <script>
            // Create chart when the page loads
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('userChart').getContext('2d');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Mahasiswa', 'Staff', 'Kaprodi'],
                        datasets: [{
                            label: 'Jumlah Pengguna',
                            data: [{{ $mahasiswaCount }}, {{ $staffCount }}, {{ $kaprodiCount }}],
                            backgroundColor: [
                                '#3B82F6', // Blue for Mahasiswa
                                '#10B981', // Green for Staff
                                '#F59E0B' // Yellow for Kaprodi
                            ],
                            borderColor: [
                                '#2563EB',
                                '#059669',
                                '#D97706'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ' + context.raw + ' orang';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah'
                                },
                                ticks: {
                                    precision: 0
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Kategori Pengguna'
                                }
                            }
                        }
                    }
                });
            });
        </script>
    </body>
@endsection
