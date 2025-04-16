@extends('components.layout')
@section('title')
    Status Pengajuan
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
                                        <span class="inline-block rounded-full px-2 py-1 text-xs font-medium 
                                            {{ $item->status_surat == 0 ? 'bg-yellow-100 text-yellow-800' : 
                                               ($item->status_surat == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $item->status_surat_text }}
                                        </span>
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


                    <!-- Pagination Links (Right) -->
                    <nav aria-label="Page navigation example" class="justify-end mt-4">
                        {{ $statusSurat->links('vendor.pagination.tailwind') }}
                    </nav>
                </div>
            </div>
        </div>
    </section>
@endsection