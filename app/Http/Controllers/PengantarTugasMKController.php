<?php

namespace App\Http\Controllers;

use App\Models\DetailSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class PengantarTugasMKController extends Controller
{
    public function storeSurat2(Request $request)
    {
        // Validate the incoming request with custom rules and messages
        $request->validate([
            'recipient' => 'required|string|min:5',        // Ditujukan Kepada, min 5 chars
            'course' => 'required|string|min:5',           // Nama Mata Kuliah - Kode Mata Kuliah, min 5 chars
            'semester' => 'required|integer|min:1|max:14', // Semester between 1 and 14
            'purpose' => 'required|string|min:5',          // Tujuan, min 5 chars
            'topic' => 'required|string|min:5',            // Topik, min 5 chars
        ], [
            'recipient.required' => 'Penerima surat wajib diisi.',
            'recipient.string' => 'Penerima surat harus berupa teks.',
            'recipient.min' => 'Penerima surat minimal 5 karakter.',
            'course.required' => 'Nama mata kuliah dan kode wajib diisi.',
            'course.string' => 'Nama mata kuliah dan kode harus berupa teks.',
            'course.min' => 'Nama mata kuliah dan kode minimal 5 karakter.',
            'semester.required' => 'Semester wajib diisi.',
            'semester.integer' => 'Semester harus berupa angka.',
            'semester.min' => 'Semester minimal adalah 1.',
            'semester.max' => 'Semester maksimal adalah 14.',
            'purpose.required' => 'Tujuan wajib diisi.',
            'purpose.string' => 'Tujuan harus berupa teks.',
            'purpose.min' => 'Tujuan minimal 5 karakter.',
            'topic.required' => 'Topik wajib diisi.',
            'topic.string' => 'Topik harus berupa teks.',
            'topic.min' => 'Topik minimal 5 karakter.',
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
                'kategori_surat' => 2,
                'tanggal_surat' => now(),
                'semester' => $request->semester,
                'tujuan_surat' => $request->purpose,
                'alamat_mhs' => null,
                'alamat_surat' => $request->recipient,
                'topik' => $request->topic,
                'nama_kode_matkul' => $request->course,
            ]);

            return redirect()->back()->with('success', 'Letter data submitted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to submit letter data: ' . $e->getMessage());
        }
    }
}