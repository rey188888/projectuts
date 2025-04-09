<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrintController extends Controller
{
    public function index()
    {
        // Ambil semua surat dengan status_surat = 1, eager load relasi surat
        $pengajuanSurat = PengajuanSurat::with('surat')
            ->where('status_surat', 1)
            ->get();

        if ($pengajuanSurat->isEmpty()) {
            $pengajuanSurat = collect([]);
        }

        return view('staff.print_surat', compact('pengajuanSurat'));
    }

    public function uploadFile(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_log' => 'required|exists:pengajuansurat,id_log',
            'file_surat' => 'required|file|mimes:pdf,doc,docx|max:2048', // Maks 2MB
        ]);

        // Temukan record berdasarkan id_log
        $pengajuanSurat = PengajuanSurat::findOrFail($request->id_log);

        // Proses upload file
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $fileName = $pengajuanSurat->id_surat . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('surat_disetujui', $fileName, 'public');

            // Simpan path file ke kolom hasil_surat di tabel detail_surat
            $detailSurat = $pengajuanSurat->surat; // Ambil relasi
            if ($detailSurat) {
                $detailSurat->hasil_surat = $path;
                $detailSurat->save();
            } else {
                return redirect()->route('staff.print')->with('error', 'Detail surat tidak ditemukan.');
            }
        }

        // Redirect kembali dengan pesan sukses
        return redirect()->route('staff.print')->with('success', 'File berhasil diupload.');
    }

    public function deleteFile(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_log' => 'required|exists:pengajuansurat,id_log',
        ]);

        // Temukan record berdasarkan id_log
        $pengajuanSurat = PengajuanSurat::findOrFail($request->id_log);

        $detailSurat = $pengajuanSurat->surat;

        if ($detailSurat && $detailSurat->hasil_surat) {
            // Hapus file dari storage
            Storage::disk('public')->delete($detailSurat->hasil_surat);

            // Set hasil_surat menjadi null di database
            $detailSurat->hasil_surat = null;
            $detailSurat->save();

            return redirect()->route('staff.print')->with('success', 'File berhasil dihapus.');
        } else {
            return redirect()->route('staff.print')->with('error', 'File tidak ditemukan atau sudah dihapus.');
        }
    }
}
