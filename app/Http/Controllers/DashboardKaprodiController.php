<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;

class DashboardKaprodiController extends Controller
{
    public function dashboard()
    {
        // Ambil data kaprodi berdasarkan id_user yang sedang login
        $kaprodi = Kaprodi::where('id_user', auth()->user()->id_user)->first();

        if (!$kaprodi) {
            return redirect()->back()->with('error', 'Data kaprodi tidak ditemukan.');
        }

        $id_prodi = $kaprodi->id_prodi;

        // Ambil semua NRP mahasiswa yang berada di bawah program studi kaprodi
        $mahasiswa = Mahasiswa::where('id_prodi', $id_prodi)->pluck('nrp')->toArray();

        if (empty($mahasiswa)) {
            // Jika tidak ada mahasiswa di prodi ini, set jumlah ke 0
            $disetujui = 0;
            $ditolak = 0;
            $menunggu = 0;
        } else {
            // Hitung jumlah surat berdasarkan status untuk mahasiswa di prodi kaprodi
            $disetujui = PengajuanSurat::whereIn('nrp', $mahasiswa)
                ->where('status_surat', 1) // Disetujui
                ->count();

            $ditolak = PengajuanSurat::whereIn('nrp', $mahasiswa)
                ->where('status_surat', 2) // Ditolak
                ->count();

            $menunggu = PengajuanSurat::whereIn('nrp', $mahasiswa)
                ->where('status_surat', 0) // Menunggu Persetujuan
                ->count();
        }

        return view('kaprodi.dashboard', compact('disetujui', 'ditolak', 'menunggu'));
    }
}