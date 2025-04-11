<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use App\Models\Mahasiswa;

class StudentController extends Controller
{
    public function dashboard()
    {
        // Ambil NRP mahasiswa berdasarkan id_user yang sedang login
        $mahasiswa = Mahasiswa::where('id_user', auth()->user()->id_user)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $nrp = $mahasiswa->nrp;

        // Hitung jumlah surat berdasarkan status
        $disetujui = PengajuanSurat::where('nrp', $nrp)
            ->where('status_surat', 1) // Disetujui
            ->count();

        $ditolak = PengajuanSurat::where('nrp', $nrp)
            ->where('status_surat', 2) // Ditolak
            ->count();

        $menunggu = PengajuanSurat::where('nrp', $nrp)
            ->where('status_surat', 0) // Menunggu Persetujuan
            ->count();

        return view('student.dashboard', compact('disetujui', 'ditolak', 'menunggu'));
    }

    public function pengajuan()
    {
        return view('student.pengajuan');
    }

    public function status()
    {
        return view('student.status');
    }
}