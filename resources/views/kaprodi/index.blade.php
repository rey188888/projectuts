@extends('components.layout')
@section('title')
    Home
@endsection
@section('content')
    <section class="bg-white py-8 antialiased md:py-16 pl-64">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
                <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                    <h1 class="text-2xl font-semibold text-gray-900">Daftar Pengajuan Surat</h1>
                    <x-sorting route="kaprodi.index" />
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID Surat</th>
                                <th scope="col" class="px-6 py-3">NRP</th>
                                <th scope="col" class="px-6 py-3">Tanggal Pengajuan</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengajuanSurat as $item)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $item->id_surat }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->nrp }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->tanggal_perubahan }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($item->status_surat == 0)
                                            <span class="inline-block rounded-full bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-800">
                                                Menunggu Persetujuan
                                            </span>
                                        @elseif ($item->status_surat == 1)
                                            <span class="inline-block rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-800">
                                                Disetujui
                                            </span>
                                        @elseif ($item->status_surat == 2)
                                            <span class="inline-block rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-800">
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="inline-block rounded-full bg-gray-100 px-2 py-1 text-xs font-medium text-gray-800">
                                                Status Tidak Diketahui
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($item->status_surat == 0)
                                            <div class="flex space-x-2">
                                                <form action="{{ route('kaprodi.updateStatus') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_surat" value="{{ $item->id_surat }}">
                                                    <input type="hidden" name="status" value="disetujui">
                                                    <button type="submit" class="rounded-lg border border-green-700 px-3 py-2 text-sm font-medium text-green-700 hover:bg-green-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-green-300">
                                                        Terima
                                                    </button>
                                                </form>
                                                <form action="{{ route('kaprodi.updateStatus') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_surat" value="{{ $item->id_surat }}">
                                                    <input type="hidden" name="status" value="ditolak">
                                                    <button type="submit" class="rounded-lg border border-red-700 px-3 py-2 text-sm font-medium text-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300">
                                                        Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-sm italic">Sudah Diproses</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No applications found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav class="mt-6 flex items-center justify-center sm:mt-8" aria-label="Page navigation example">
                    <ul class="flex h-8 items-center -space-x-px text-sm">
                        <li>
                            <a href="#" class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                                <span class="sr-only">Previous</span>
                                <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                                </svg>
                            </a>
                        </li>
                        <li><a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700">1</a></li>
                        <li><a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700">2</a></li>
                        <li><a href="#" aria-current="page" class="z-10 flex h-8 items-center justify-center border border-primary-300 bg-primary-50 px-3 leading-tight text-primary-600 hover:bg-primary-100 hover:text-primary-700">3</a></li>
                        <li><a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700">...</a></li>
                        <li><a href="#" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700">100</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
@endsection
