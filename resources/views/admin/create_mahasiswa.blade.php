@extends('components.layout')

@section('title')
    Tambah Mahasiswa
@endsection

@section('content')
<div class="flex min-h-screen bg-gray-100">
    @include('components.sidebar')

    <div class="flex-1 ml-64">
        <div class="container mx-auto p-6">
            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Form Tambah Mahasiswa</h2>

                <form action="{{ route('admin.store.mahasiswa') }}" method="POST">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 font-medium">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                        @error('nama')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium">Email</label>
                        <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NRP -->
                    <div class="mb-4">
                        <label for="nrp" class="block text-gray-700 font-medium">NRP</label>
                        <input type="text" name="nrp" id="nrp" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                        @error('nrp')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Program Studi -->
                    <div class="mb-4">
                        <label for="id_prodi" class="block text-gray-700 font-medium">Program Studi</label>
                        <select name="id_prodi" id="id_prodi" class="w-full p-2 border border-gray-300 rounded mt-1 bg-white"
                                required>
                            @foreach ($programstudi as $prodi)
                                <option value="{{ $prodi->id_prodi }}" {{ old('id_prodi') == $prodi->id_prodi ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_prodi')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 font-medium">Password</label>
                        <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                        @error('password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded hover:bg-blue-700">
                        Simpan Mahasiswa
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
