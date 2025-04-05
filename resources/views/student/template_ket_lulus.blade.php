@extends('components.layout')

@section('title')
    Surat Keterangan Lulus
@endsection

@section('content')
    <section class="bg-white flex flex-col md:flex-row h-[100vh] ml-64">
        <!-- Form Section -->
        <div class="basis-1/2 p-10 flex items-center justify-center bg-red-500">
            <div
                class="w-full h-fit rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Isi Data Mahasiswa
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('detailsurat.storeSurat3') }}" method="POST">
                        @csrf
                        <!-- Tanggal Kelulusan -->
                        <div>
                            <label for="graduation_date"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                Kelulusan</label>
                            <input type="date" name="graduation_date" id="graduation_date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ old('graduation_date') }}" required>
                            @error('graduation_date')
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

        <!-- Image Section -->
        <div class="basis-1/2 p-6 flex items-center justify-center">
            <img src="https://via.placeholder.com/600x800" alt="Template Surat"
                class="max-w-full max-h-full object-contain">
        </div>
    </section>
@endsection
