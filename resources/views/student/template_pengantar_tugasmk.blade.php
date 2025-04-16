@extends('components.layout')

@section('title')
    Surat Pengantar Tugas Mata Kuliah
@endsection

@section('content')
    <section class="bg-white flex items-center justify-center h-screen ml-64">
        <!-- Form Section -->
            <div class="w-full h-fit rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Isi Data Mahasiswa
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('detailsurat.storeSurat2') }}" method="POST">
                        @csrf
                        <!-- Ditujukan Kepada -->
                        <div>
                            <label for="recipient" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ditujukan Kepada</label>
                            <input type="text" name="recipient" id="recipient" placeholder="Enter recipient name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ old('recipient') }}" required>
                            @error('recipient')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Mata Kuliah - Kode Mata Kuliah -->
                        <div>
                            <label for="course" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Mata Kuliah - Kode Mata Kuliah</label>
                            <input type="text" name="course" id="course" placeholder="e.g., Pemrograman - IF101"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ old('course') }}" required>
                            @error('course')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Semester -->
                        <div>
                            <label for="semester" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Semester</label>
                            <input type="number" name="semester" id="semester" placeholder="Enter your semester"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ old('semester') }}" required>
                            @error('semester')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tujuan -->
                        <div>
                            <label for="purpose" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tujuan</label>
                            <input type="text" name="purpose" id="purpose" placeholder="Enter your purpose"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ old('purpose') }}" required>
                            @error('purpose')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Topik -->
                        <div>
                            <label for="topic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Topik</label>
                            <input type="text" name="topic" id="topic" placeholder="Enter your topic"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ old('topic') }}" required>
                            @error('topic')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Kirim</button>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection