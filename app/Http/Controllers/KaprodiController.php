<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function index(Request $request)
    {
        // Get the status filter from the request
        $statusFilter = $request->query('status_filter');

        // Build the query
        $query = PengajuanSurat::query();

        // Apply filter if status_filter is provided and not empty
        if ($statusFilter !== null && $statusFilter !== '') {
            $query->where('status_surat', $statusFilter);
        }

        // Fetch the filtered data
        $pengajuanSurat = $query->get();

        // Pass the data to the view
        return view('kaprodi.index', compact('pengajuanSurat'));
    }

    public function updateStatus(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id_surat' => 'required|exists:pengajuansurat,id_surat',
            'status' => 'required|in:disetujui,ditolak',
        ]);

        // Find the PengajuanSurat record by id_surat
        $pengajuanSurat = PengajuanSurat::where('id_surat', $request->id_surat)->firstOrFail();

        // Update the status_surat based on the action
        if ($request->status === 'disetujui') {
            $pengajuanSurat->status_surat = 1; // Set to 1 for "diterima"
        } elseif ($request->status === 'ditolak') {
            $pengajuanSurat->status_surat = 2; // Set to 2 for "ditolak"
        }

        // Save the updated record
        $pengajuanSurat->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Status surat berhasil diperbarui.');
    }
}