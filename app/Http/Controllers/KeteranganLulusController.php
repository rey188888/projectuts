<?php

namespace App\Http\Controllers;

use App\Models\DetailSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Mahasiswa;

class KeteranganLulusController extends Controller
{
    public function storeSurat3(Request $request)
    {
        // Validate the incoming request based on the form fields
        // $request->validate([
        //     'graduation_date' => 'required|date_format:d/m/Y', // Tanggal Kelulusan in dd/mm/yyyy format
        // ]);

        // Fetch the authenticated user's NRP and name
        $user = Auth::user();
        $nrp = User::where('id_user', $user->id_user)->value('nrp');
        $nama = Mahasiswa::where('nrp', $nrp)->value('nama');

        // Create a new letter entry with the form data
        DetailSurat::create([
            'nrp' => $nrp,
            'nama' => $nama,
            'semester' => null, // useless column
            'alamat_mhs' => null, // useless column
            'tujuan_surat' => null, // useless column
            'tanggal_surat' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->graduation_date), // Convert the date to a proper format for storage
            'kategori_surat' => 3,
            'alamat_surat' => null, // useless column
            'topik' => null, // useless column
            'nama_kode_matkul' => null, // useless column
        ]);

        return redirect()->back()->with('success', 'Letter data submitted successfully!');
    }
}