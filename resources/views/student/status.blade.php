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
                    <x-sorting route="student.status" />
                </div>
                <div class="mt-6 flow-root sm:mt-8">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID Surat</th>
                                <th scope="col" class="px-6 py-3">Tanggal Pengajuan</th>
                                <th scope="col" class="px-6 py-3">Kategori</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Alasan Penolakan</th>
                                <th scope="col" class="px-6 py-3">File Surat</th>
                            </tr>
                        </thead>
                        <tbody>
    @forelse ($statusSurat as $item)
        <tr class="bg-white border-b hover:bg-gray-50">
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $item->id_surat }}
            </td>
            <td class="px-6 py-4">
                {{ $item->tanggal_perubahan }}
            </td>
            <td class="px-6 py-4">
                {{ $item->kategori_surat }}
            </td>
            <td class="px-6 py-4">
                @switch($item->status_surat)
                    @case(0)
                        <span class="inline-block rounded-full bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-800">
                            Menunggu Persetujuan
                        </span>
                        @break
                    @case(1)
                        <span class="inline-block rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-800">
                            Disetujui
                        </span>
                        @break
                    @case(2)
                        <span class="inline-block rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-800">
                            Ditolak
                        </span>
                        @break
                @endswitch
            </td>
            <td class="px-6 py-4">
                @if ($item->status_surat == 2 && !empty($item->keterangan_penolakan))
                    {{ $item->keterangan_penolakan }}
                @else
                    -
                @endif
            </td>
            <td class="px-6 py-4">
                @if ($item->hasil_surat)
                    <a href="{{ asset('storage/' . $item->hasil_surat) }}" target="_blank" class="text-blue-600 hover:underline">Lihat File</a>
                @else
                    <span class="text-gray-400 text-sm italic">Belum Ada File</span>
                @endif
            </td>
        </tr>
    @empty
        <tr class="bg-white border-b hover:bg-gray-50">
            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                No applications found.
            </td>
        </tr>
    @endforelse
</tbody>
                    </table>
                </div> <!-- penutup div .flow-root -->

                <!-- PAGINATION dipindah ke luar dari flow-root -->
                <nav class="mt-6 flex items-center justify-center sm:mt-8" aria-label="Page navigation example">
                    <ul class="flex h-8 items-center -space-x-px text-sm">
                        <li>
                            <a href="#"
                                class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m15 19-7-7 7-7" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                        </li>
                        <li>
                            <a href="#" aria-current="page"
                                class="z-10 flex h-8 items-center justify-center border border-primary-300 bg-primary-50 px-3 leading-tight text-primary-600 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m9 5 7 7-7 7" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </section>
@endsection
