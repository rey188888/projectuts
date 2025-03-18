<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Surat;
use App\Models\Mahasiswa;

class MhsAktifController extends Controller
{
    public function storeSurat1(Request $request)
    {

        $request->validate([
            'semester' => 'required|integer',
            'address' => 'required|string',
            'purpose' => 'required|string',
        ]);

        // Fetch the authenticated user's NRP and name
        $user = Auth::user();
        $nrp = User::where('id_user', $user->id_user)->value('nrp');
        $nama = Mahasiswa::where('nrp', $user->nrp)->value('nama');

        // Create a new letter entry
        Surat::create([
            'nrp' => $nrp,
            'nama' => $nama,
            'kategori_surat' => 1,
            'tanggal_surat' => now(), // Set to current date
            'semester' => $request->semester,
            'tujuan_surat' => $request->purpose,
            'alamat_mhs' => $request->address,
            'alamat_surat' => null,   // Unwanted column
            'topik' => null,          // Unwanted column
            'nama_kode_matkul' => null, // Unwanted column
        ]);

        return redirect()->back()->with('success', 'Letter data submitted successfully!');
    }
}
