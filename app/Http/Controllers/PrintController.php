<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrintController extends Controller
{
    public function index()
    {
        // Ambil semua pengajuan surat dengan status_surat = 1, join dengan detail_surat
        $pengajuanSurat = PengajuanSurat::query()
            ->leftJoin('detail_surat', 'pengajuansurat.id_surat', '=', 'detail_surat.id_surat')
            ->leftJoin('mahasiswa', 'pengajuansurat.nrp', '=', 'mahasiswa.nrp')
            ->select(
                'pengajuansurat.*',
                'detail_surat.hasil_surat',
                'detail_surat.tujuan_surat',
                'detail_surat.alamat_mhs',
                'detail_surat.alamat_surat',
                'detail_surat.topik',
                'detail_surat.nama_kode_matkul',
                'detail_surat.semester',
                'detail_surat.nama',
                'detail_surat.kategori_surat',
                'detail_surat.tanggal_surat',
                'mahasiswa.tanggal_kelulusan'
            )
            ->where('pengajuansurat.status_surat', 1)
            ->get();

        return view('staff.print_surat', compact('pengajuanSurat'));
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'id_log' => 'required|exists:pengajuansurat,id_log',
            'file_surat' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $pengajuanSurat = PengajuanSurat::findOrFail($request->id_log);

        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $fileName = $pengajuanSurat->id_surat . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('surat_disetujui', $fileName, 'public');

            $detailSurat = $pengajuanSurat->surat;
            if ($detailSurat) {
                $detailSurat->hasil_surat = $path;
                $detailSurat->save();
            } else {
                return redirect()->route('staff.print')->with('error', 'Detail surat tidak ditemukan.');
            }
        }

        return redirect()->route('staff.print')->with('success', 'File berhasil diupload.');
    }

    public function deleteFile(Request $request)
    {
        $request->validate([
            'id_log' => 'required|exists:pengajuansurat,id_log',
        ]);

        $pengajuanSurat = PengajuanSurat::findOrFail($request->id_log);
        $detailSurat = $pengajuanSurat->surat;

        if ($detailSurat && $detailSurat->hasil_surat) {
            Storage::disk('public')->delete($detailSurat->hasil_surat);
            $detailSurat->hasil_surat = null;
            $detailSurat->save();

            return redirect()->route('staff.print')->with('success', 'File berhasil dihapus.');
        } else {
            return redirect()->route('staff.print')->with('error', 'File tidak ditemukan atau sudah dihapus.');
        }
    }
}
