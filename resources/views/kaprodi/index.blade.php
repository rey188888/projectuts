@extends('components.layout')

@section('title')
    Daftar Surat
@endsection

@section('content')
<section class="bg-white py-8 antialiased md:py-16 pl-64">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-5xl">

            @if (session('success'))
                <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <h1 class="text-2xl font-semibold text-gray-900">Daftar Pengajuan Surat</h1>
                <x-sorting route="kaprodi.index" />
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID Surat</th>
                            <th scope="col" class="px-6 py-3">NRP</th>
                            <th scope="col" class="px-6 py-3">Tanggal Pengajuan</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Data Surat</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                            <th scope="col" class="px-6 py-3">File Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengajuansurat as $item)
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
                                    <span class="inline-block rounded-full px-2 py-1 text-xs font-medium 
                                        {{ $item->status_surat == 0 ? 'bg-yellow-100 text-yellow-800' : 
                                           ($item->status_surat == 1 ? 'bg-green-100 text-green-800' : 
                                           ($item->status_surat == 2 ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                        {{ $item->status_surat == 0 ? 'Menunggu Persetujuan' : 
                                           ($item->status_surat == 1 ? 'Disetujui' : 
                                           ($item->status_surat == 2 ? 'Ditolak' : 'Status Tidak Diketahui')) }}
                                    </span>
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
                                            <button type="button" onclick="bukaModal('{{ $item->id_surat }}')" class="rounded-lg border border-red-700 px-3 py-2 text-sm font-medium text-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300">
                                                Tolak
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm italic">Sudah Diproses</span>
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
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada data pengajuan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

                <!-- Pagination Links (Right) -->
                <nav aria-label="Page navigation example" class="justify-end mt-4">
                    {{ $pengajuansurat->links('vendor.pagination.tailwind') }}
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tolak -->
<div id="modalTolak" class="fixed inset-0 z-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-full max-w-xl overflow-auto max-h-[80vh] border border-gray-300">
        <h2 class="text-xl font-semibold mb-4">Alasan Penolakan</h2>
        <form id="formTolak" method="POST" action="{{ route('kaprodi.updateStatus') }}">
            @csrf
            <input type="hidden" name="id_surat" id="modal-id-surat">
            <input type="hidden" name="status" value="ditolak">
            <textarea name="keterangan_penolakan" rows="4" class="w-full border rounded p-2" placeholder="Masukkan alasan penolakan" required></textarea>
            <div class="mt-4 flex justify-end space-x-2">
                <button type="button" onclick="tutupModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Kirim</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail Surat -->
<div id="modalDetailSurat" class="fixed inset-0 z-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-full max-w-md border border-gray-300">
        <h2 class="text-xl font-semibold mb-4">Detail Surat</h2>
        <div id="isiDetailSurat" class="text-gray-700 space-y-2">
            <!-- Akan diisi lewat JS -->
        </div>
        <div class="mt-4 text-right">
            <button onclick="tutupModalDetail()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Tutup</button>
        </div>
    </div>
</div>

<script>
    function bukaModalDetail(item) {
        let isi = '';

        switch (item.kategori_surat) {
            case 1:
                isi += `<p><strong>Semester:</strong> ${item.semester || '-'}</p>`;
                isi += `<p><strong>Tujuan Surat:</strong> ${item.tujuan_surat || '-'}</p>`;
                break;
            case 2:
                isi += `<p><strong>Semester:</strong> ${item.semester || '-'}</p>`;
                isi += `<p><strong>Tujuan Surat:</strong> ${item.tujuan_surat || '-'}</p>`;
                isi += `<p><strong>Alamat Surat:</strong> ${item.alamat_surat || '-'}</p>`;
                isi += `<p><strong>Topik:</strong> ${item.topik || '-'}</p>`;
                isi += `<p><strong>Nama Kode Matkul:</strong> ${item.nama_kode_matkul || '-'}</p>`;
                break;
            case 3:
                isi += `<p><strong>Tanggal Kelulusan:</strong> ${item.tanggal_kelulusan || '-'}</p>`;
                break;
            case 4:
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

    function bukaModal(idSurat) {
        document.getElementById('modal-id-surat').value = idSurat;
        const modal = document.getElementById('modalTolak');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function tutupModal() {
        const modal = document.getElementById('modalTolak');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection