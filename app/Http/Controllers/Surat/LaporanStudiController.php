<?php

namespace App\Http\Controllers\Surat;

use App\Models\DetailSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa; // Changed back to Mahasiswa
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;

class LaporanStudiController extends Controller
{
    public function storeSurat4(Request $request)
    {
        // Step 1: Validate the incoming request with custom messages
        $validated = $request->validate([
            'purpose_lhs' => 'required|string|min:5|max:100',
        ], [
            'purpose_lhs.required' => 'Keperluan pembuatan LHS wajib diisi.',
            'purpose_lhs.min' => 'Keperluan pembuatan LHS minimal 5 karakter.',
            'purpose_lhs.max' => 'Keperluan pembuatan LHS maksimal 100 karakter.',
        ]);

        // Step 2: Fetch the authenticated user
        $user = Auth::user();

        // Step 3: Fetch the student's name in a single query
        $mahasiswa = Mahasiswa::where('id_user', $user->id_user)
            ->select('nama', 'nrp') // Removed 'nrp' since we won't use it
            ->first();

        // Check if the Mahasiswa record exists
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Pengguna tidak terdaftar sebagai mahasiswa.');
        }

        $nama = $mahasiswa->nama;

        // Step 4: Begin a transaction
        DB::beginTransaction();

        try {
            // Step 5: Find the highest existing number for the SLHS format
            $latestSurat = DetailSurat::where('id_surat', 'LIKE', '%/SLHS')
                ->orderByRaw('CAST(SUBSTRING_INDEX(id_surat, "/", 1) AS UNSIGNED) DESC')
                ->first();

            $highestNumber = 0;
            if ($latestSurat) {
                $parts = explode('/', $latestSurat->id_surat);
                if (isset($parts[0]) && is_numeric($parts[0])) {
                    $highestNumber = (int)$parts[0];
                }
            }

            // Step 6: Generate the next ID in the format 001/SLHS
            $nextNumber = $highestNumber + 1;
            $formattedIdSurat = sprintf("%03d/SLHS", $nextNumber);

            // Step 7: Create and save the new DetailSurat record
            $detailSurat = new DetailSurat();
            $detailSurat->id_surat = $formattedIdSurat;
            // Removed: $detailSurat->nrp = $nrp; since the column doesn't exist
            $detailSurat->nama = $nama;
            $detailSurat->semester = null;
            $detailSurat->alamat_mhs = null;
            $detailSurat->tujuan_surat = $validated['purpose_lhs'];
            $detailSurat->tanggal_surat = now();
            $detailSurat->kategori_surat = 4;
            $detailSurat->alamat_surat = null;
            $detailSurat->topik = null;
            $detailSurat->nama_kode_matkul = null;
            $detailSurat->save();

            // Step 8: Commit the transaction
            DB::commit();

            PengajuanSurat::create([
                'status_surat' => 0,
                'tanggal_perubahan' => now(),
                'keterangan_penolakan' => null,
                'nrp' => $mahasiswa->nrp,
                'id_surat' => $formattedIdSurat,
                'id_user' => $user->id_user,
                'id_staff' => null,
                'id_kaprodi' => null,
            ]);

            return redirect()->back()->with('success', 'Surat berhasil diajukan dengan nomor: ' . $formattedIdSurat);
        } catch (\Exception $e) {
            // Step 9: Rollback the transaction if an error occurs
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
}