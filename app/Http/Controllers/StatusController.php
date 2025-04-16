<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class StatusController extends Controller
{
    public function index(Request $request)
    {
        // Get the status filter from the request
        $statusFilter = $request->query('status_filter');

        // Get the authenticated user's NRP (assuming the user is linked to a mahasiswa record)
        $nrp = auth()->user()->mahasiswa->nrp ?? null;

        if (!$nrp) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        // Build the query using DB::table
        $query = DB::table('pengajuansurat as p')
            ->select(
                'p.id_surat',
                'p.tanggal_perubahan',
                'd.kategori_surat',
                'p.status_surat',
                'p.keterangan_penolakan',
                'd.hasil_surat'
            )
            ->leftJoin('detail_surat as d', 'p.id_surat', '=', 'd.id_surat')
            ->where('p.nrp', $nrp); // Filter by the student's NRP

        // Add WHERE clause if status_filter is provided and not empty
        if ($statusFilter !== null && $statusFilter !== '') {
            $query->where('p.status_surat', $statusFilter);
        }

        // Paginate the results (10 per page)
        $perPage = 10;
        $statusSurat = $query->paginate($perPage);

        // Transform the paginated data for displawy
        $statusSurat->getCollection()->transform(function ($item) {
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
        });

        // Pass the paginated data to the view
        return view('student.status', compact('statusSurat'));
    }
}