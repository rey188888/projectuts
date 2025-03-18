<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;
use App\Models\Mahasiswa;
use App\Models\User;

class PengantarTugasMKController extends Controller
{
    public function storeSurat2(Request $request)
    {
        // Validate the incoming request based on the form fields
        $request->validate([
            'recipient' => 'required|string', // Ditujukan Kepada
            'course' => 'required|string', // Nama Mata Kuliah - Kode Mata Kuliah
            'semester' => 'required|integer', // Semester
            'purpose' => 'required|string', // Tujuan
            'topic' => 'required|string', // Topik
        ]);

        // Fetch the authenticated user's NRP and name
        $user = Auth::user();
        $nrp = User::where('id_user', $user->id_user)->value('nrp');
        $nama = Mahasiswa::where('nrp', $nrp)->value('nama');

        // Create a new letter entry
        Surat::create([
            'nrp' => $nrp,
            'nama' => $nama,
            'kategori_surat' => 2,
            'tanggal_surat' => now(), // Set to current date
            'semester' => $request->semester,
            'tujuan_surat' => $request->purpose,
            'alamat_mhs' => null,  // Unwanted column
            'alamat_surat' => $request->recipient,
            'topik' => $request->topic,
            'nama_kode_matkul' => $request->course,
        ]);

        return redirect()->back()->with('success', 'Letter data submitted successfully!');
    }
}
