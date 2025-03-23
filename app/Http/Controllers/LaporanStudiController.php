<?php

namespace App\Http\Controllers;

use App\Models\DetailSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class LaporanStudiController extends Controller
{
    public function storeSurat4(Request $request)
    {
        // Validate the incoming request with custom messages

        $request->validate([
            'purpose_lhs' => 'required|string|min:5|max:100', // Match the form field name
        ], [
            'purpose_lhs.required' => 'Keperluan pembuatan LHS wajib diisi.',
            'purpose_lhs.min' => 'Keperluan pembuatan LHS minimal 5 karakter.',
            'purpose_lhs.max' => 'Keperluan pembuatan LHS maksimal 100 karakter.',
        ]);

        // Fetch the authenticated user
        $user = Auth::user();

        // Fetch the Mahasiswa record associated with the authenticated user
        $mahasiswa = Mahasiswa::where('id_user', $user->id_user)->first();

        // Check if the Mahasiswa record exists
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa record not found for this user.');
        }

        // Get nama from the Mahasiswa record
        $nama = $mahasiswa->nama;

        // Create a new letter entry with the form data
        try {
            DetailSurat::create([
                'nama' => $nama,
                'semester' => null,
                'alamat_mhs' => null,
                'tujuan_surat' => $request->purpose_lhs, // Use purpose_lhs to match the form field
                'tanggal_surat' => now(),
                'kategori_surat' => 4,
                'alamat_surat' => null,
                'topik' => null,
                'nama_kode_matkul' => null,
            ]);

            return redirect()->back()->with('success', 'Letter data submitted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to submit letter data: ' . $e->getMessage());
        }
    }
}