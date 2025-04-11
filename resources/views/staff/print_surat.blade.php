@extends('components.layout')

@section('title')
    Daftar Surat Disetujui
@endsection

@section('content')
<section class="bg-white py-8 antialiased md:py-16 pl-64">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-5xl">
            <div class="gap-4 sm:flex sm:items-center sm:justify-between mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">Daftar Surat Disetujui</h1>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID Log</th>
                            <th scope="col" class="px-6 py-3">ID Surat</th>
                            <th scope="col" class="px-6 py-3">NRP</th>
                            <th scope="col" class="px-6 py-3">Tgl Pengajuan</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">File Surat</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengajuanSurat as $item)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    <a href="#" class="hover:underline">{{ $item->id_log }}</a>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->id_surat }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->nrp }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->tanggal_perubahan }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-block rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-800">
                                        Disetujui
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->surat && $item->surat->hasil_surat)
                                        <a href="{{ Storage::url($item->surat->hasil_surat) }}" class="text-blue-600 hover:underline" target="_blank">Lihat File</a>
                                    @else
                                        <span class="text-gray-500">Belum diupload</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->surat && $item->surat->hasil_surat)
                                        <form action="{{ route('staff.deleteFile') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus file ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id_log" value="{{ $item->id_log }}">
                                            <button type="submit" class="rounded-lg border border-red-700 px-3 py-2 text-sm font-medium text-red-700 hover:bg-red-700 hover:text-white focus:outline-none">
                                                Delete File
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('staff.uploadFile') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                                            @csrf
                                            <input type="hidden" name="id_log" value="{{ $item->id_log }}">
                                            
                                            <label id="label-file-{{ $item->id_log }}" for="file-{{ $item->id_log }}" class="inline-block cursor-pointer rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                                                Pilih File
                                            </label>
                                            
                                            <input id="file-{{ $item->id_log }}" type="file" name="file_surat" class="hidden" onchange="hideLabel('{{ $item->id_log }}')">
                                            
                                            <button type="submit" class="rounded-lg border border-blue-700 px-3 py-2 text-sm font-medium text-blue-700 hover:bg-blue-700 hover:text-white focus:outline-none">
                                                Upload
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada surat disetujui yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    function hideLabel(idLog) {
        const label = document.getElementById('label-file-' + idLog);
        if (label) {
            label.style.display = 'none';
        }
    }
</script>
@endsection
