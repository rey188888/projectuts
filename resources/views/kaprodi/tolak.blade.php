@extends('components.layout')

@section('title')
    Tolak Surat
@endsection

@section('content')
<section class="bg-white py-8 antialiased md:py-16 pl-64">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-2xl">

            <h1 class="text-2xl font-semibold text-gray-900 mb-6">Tolak Pengajuan Surat</h1>

            <form action="{{ route('kaprodi.updateStatus') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                <input type="hidden" name="id_surat" value="{{ $id }}">
                <input type="hidden" name="status" value="ditolak">

                <div class="mb-4">
                    <label for="alasan_tolak" class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                    <textarea name="alasan_tolak" id="alasan_tolak" rows="5" class="w-full border border-gray-300 rounded-lg p-3" required>{{ old('alasan_tolak') }}</textarea>
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('kaprodi.index') }}" class="px-4 py-2 text-gray-600 border rounded-lg hover:bg-gray-100">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Kirim Penolakan</button>
                </div>
            </form>

        </div>
    </div>
</section>
@endsection
