<?php

namespace App\Http\Controllers;

use App\Models\DetailSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class MhsAktifController extends Controller
{
    public function storeSurat1(Request $request)
    {
        // Validate the request with custom rules and messages
        $request->validate([
            'semester' => 'required|integer|min:1|max:14', // Semester between 1 and 14
            'address' => 'required|string|min:5',          // Address min 5 characters
            'purpose' => 'required|string|min:5',          // Purpose min 5 characters
        ], [
            'semester.required' => 'Semester wajib diisi.',
            'semester.integer' => 'Semester harus berupa angka.',
            'semester.min' => 'Semester minimal adalah 1.',
            'semester.max' => 'Semester maksimal adalah 14.',
            'address.required' => 'Alamat wajib diisi.',
            'address.string' => 'Alamat harus berupa teks.',
            'address.min' => 'Alamat minimal 5 karakter.',
            'purpose.required' => 'Keperluan wajib diisi.',
            'purpose.string' => 'Keperluan harus berupa teks.',
            'purpose.min' => 'Keperluan minimal 5 karakter.',
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

        // Create a new letter entry
        try {
            DetailSurat::create([
                'nama' => $nama,
                'kategori_surat' => 1,
                'tanggal_surat' => now(),
                'semester' => $request->semester,
                'tujuan_surat' => $request->purpose,
                'alamat_mhs' => $request->address,
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