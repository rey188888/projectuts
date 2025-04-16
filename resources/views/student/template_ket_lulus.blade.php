@extends('components.layout')

@section('title')
    Surat Keterangan Lulus
@endsection

@section('content')
    <section class="bg-red-500 flex items-center justify-center h-screen ml-64">
        <!-- Form Section -->
            <div
                class="w-full h-fit rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Ajukan Surat Keterangan Lulus
                    </h1>
                        <script>
                            setTimeout(() => {
                                const popup = document.getElementById('successPopup');
                                if (popup) popup.style.display = 'none';
                            }, 3000);
                        </script>
                    

                    <!-- POPUP Error -->
                    @if (session('error'))
                        <div class="bg-red-500 text-white p-3 rounded mb-4 text-center shadow-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form class="space-y-4" action="{{ route('detailsurat.storeSurat3') }}" method="POST">
                        @csrf
                        <div>
                            <label for="graduation_date"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                Kelulusan</label>
                            <input type="date" name="graduation_date" id="graduation_date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                value="{{ old('graduation_date') }}" required>
                            @error('graduation_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Kirim Pengajuan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
