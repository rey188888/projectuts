@extends('components.layout')

@section('title')
    Print Surat
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
                            <th scope="col" class="px-6 py-3">Data Surat</th>
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
                                    <button onclick='bukaModalDetail({
                                        kategori_surat: {{ $item->kategori_surat ?? 'null' }},
                                        semester: @json($item->semester),
                                        tujuan_surat: @json($item->tujuan_surat),
                                        alamat_surat: @json($item->alamat_surat),
                                        topik: @json($item->topik),
                                        nama_kode_matkul: @json($item->nama_kode_matkul),
                                        tanggal_kelulusan: @json($item->tanggal_kelulusan)
                                    })'
                                    class="rounded-lg border border-blue-700 px-3 py-2 text-sm font-medium text-blue-700 hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-blue-300">
                                        Lihat Data Surat
                                    </button>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-block rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-800">
                                        Disetujui
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->hasil_surat)
                                        <a href="{{ Storage::url($item->hasil_surat) }}" class="text-blue-600 hover:underline" target="_blank">Lihat File</a>
                                    @else
                                        <span class="text-gray-500">Belum diupload</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->hasil_surat)
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
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada surat disetujui yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

                <!-- Pagination Links (Right) -->
                <nav aria-label="Page navigation example" class="justify-end mt-4">
                    {{ $pengajuanSurat->links('vendor.pagination.tailwind') }}
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Modal Detail Surat -->
<div id="modalDetailSurat" class="fixed inset-0 z-50 hidden items-center justify-center ">
    <div class="bg-white p-6 rounded-lg w-full max-w-xl overflow-auto max-h-[80vh] border border-gray-300">
        <h2 class="text-xl font-semibold mb-4">Detail Surat</h2>
        <div id="isiDetailSurat" class="text-gray-700 space-y-2">
            <!-- Diisi via JS -->
        </div>
        <div class="mt-4 text-right">
            <button onclick="tutupModalDetail()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Tutup</button>
        </div>
    </div>
</div>

<script>
    function hideLabel(idLog) {
        const label = document.getElementById('label-file-' + idLog);
        if (label) {
            label.style.display = 'none';
        }
    }

    function bukaModalDetail(item) {
        let isi = '';

        switch (item.kategori_surat) {
            case 1: // SKMA
                isi += `<p><strong>Semester:</strong> ${item.semester || '-'}</p>`;
                isi += `<p><strong>Tujuan Surat:</strong> ${item.tujuan_surat || '-'}</p>`;
                break;

            case 2: // SPTMK
                isi += `<p><strong>Semester:</strong> ${item.semester || '-'}</p>`;
                isi += `<p><strong>Tujuan Surat:</strong> ${item.tujuan_surat || '-'}</p>`;
                isi += `<p><strong>Alamat Surat:</strong> ${item.alamat_surat || '-'}</p>`;
                isi += `<p><strong>Topik:</strong> ${item.topik || '-'}</p>`;
                isi += `<p><strong>Nama Kode Matkul:</strong> ${item.nama_kode_matkul || '-'}</p>`;
                break;
            case 3: // SKL
                isi += `<p><strong>Tanggal Kelulusan:</strong> ${item.tanggal_kelulusan|| '-'}</p>`;
                break;
            case 4: // SLHS
                isi += `<p><strong>Tujuan Surat:</strong> ${item.tujuan_surat || '-'}</p>`;
                break;

            default:
                isi = `<p>Data surat tidak dikenali atau belum lengkap.</p>`;
        }

        document.getElementById('isiDetailSurat').innerHTML = isi;
        document.getElementById('modalDetailSurat').classList.remove('hidden');
        document.getElementById('modalDetailSurat').classList.add('flex');
    }

    function tutupModalDetail() {
        document.getElementById('modalDetailSurat').classList.add('hidden');
        document.getElementById('modalDetailSurat').classList.remove('flex');
    }
</script>
@endsection