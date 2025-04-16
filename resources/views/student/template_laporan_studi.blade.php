@extends('components.layout')

@section('title')
    Surat Laporan Hasil Studi
@endsection

@section('content')
    <section class="bg-red-500 flex items-center justify-center h-screen ml-64">
        <!-- Form Section -->
            <div
                class="w-full h-fit rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Isi Data Mahasiswa
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('detailsurat.storeSurat4') }}" method="POST">
                        @csrf
                        <div>
                            <label for="purpose_lhs"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keperluan Pembuatan
                                LHS</label>
                            <input type="text" name="purpose_lhs" id="purpose_lhs" placeholder="Enter your purpose"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ old('purpose_lhs') }}" required>
                            @error('purpose_lhs')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
