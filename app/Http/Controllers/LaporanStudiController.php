<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Surat;
use App\Models\Mahasiswa;

class LaporanStudiController extends Controller
{
    public function storeSurat4(Request $request)
    {
        // Validate the incoming request based on the form fields
        $request->validate([
            'purpose' => 'required|string', // Keperluan Pembuatan LHS
        ]);

        // Fetch the authenticated user's NRP and name
        $user = Auth::user();
        $nrp = User::where('id_user', $user->id_user)->value('nrp');
        $nama = Mahasiswa::where('nrp', $nrp)->value('nama');

        // Create a new letter entry with the form data
        Surat::create([
            'nrp' => $nrp,
            'nama' => $nama,
            'semester' => null, // Unwanted column
            'alamat_mhs' => null, // Unwanted column
            'tujuan_surat' => $request->purpose,
            'tanggal_surat' => now(),
            'kategori_surat' => 4,
            'alamat_surat' => null, // Unwanted column
            'topik' => null, // Unwanted column
            'nama_kode_matkul' => null, // Unwanted column
        ]);

        return redirect()->back()->with('success', 'Letter data submitted successfully!');
    }
}