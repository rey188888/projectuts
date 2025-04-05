<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{
    public function index(Request $request)
    {
        // Raw query to join pengajuansurat and detail_surat tables
        $statusSurat = DB::select("
            SELECT 
                p.id_surat,
                p.tanggal_perubahan,
                d.kategori_surat,
                p.status_surat
            FROM pengajuansurat p
            LEFT JOIN detail_surat d ON p.id_surat = d.id_surat
        ");

        // Transform the data for display
        $statusSurat = array_map(function ($item) {
            // Map kategori_surat
            $kategoriMap = [
                1 => 'SKMA',
                2 => 'SPTMK',
                3 => 'SKL',
                4 => 'SLHS',
            ];
            $item->kategori_surat = $kategoriMap[$item->kategori_surat] ?? 'Unknown';

            // Map status_surat
            $statusMap = [
                0 => 'Menunggu Persetujuan',
                1 => 'Disetujui',
                2 => 'Ditolak',
            ];
            $item->status_surat_text = $statusMap[$item->status_surat] ?? 'Unknown';

            return $item;
        }, $statusSurat);

        // Pass the data to the view
        return view('student.status', compact('statusSurat'));
    }
}