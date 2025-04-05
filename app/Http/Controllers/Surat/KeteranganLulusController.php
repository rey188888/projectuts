<?php

namespace App\Http\Controllers\Surat;

use App\Models\DetailSurat;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student; // Changed from Mahasiswa to Student
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class KeteranganLulusController extends Controller
{
    public function storeSurat3(Request $request)
    {
        // Step 1: Validate the incoming request
        $validated = $request->validate([
            'graduation_date' => 'required|date_format:d/m/Y', // Ensure the date is in dd/mm/yyyy format
        ], [
            'graduation_date.required' => 'Tanggal kelulusan wajib diisi.',
            'graduation_date.date_format' => 'Tanggal kelulusan harus dalam format dd/mm/yyyy.',
        ]);

        // Step 2: Fetch the authenticated user
        $user = Auth::user();

        // Step 3: Fetch the student's NRP and name in a single query
        $student = Mahasiswa::where('id_user', $user->id_user)
            ->select('nrp', 'nama')
            ->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Pengguna tidak terdaftar sebagai student.');
        }

        $nrp = $student->nrp;
        $nama = $student->nama;

        // Step 4: Begin a transaction
        DB::beginTransaction();

        try {
            // Step 5: Find the highest existing number for the SKL format
            $latestSurat = DetailSurat::where('id_surat', 'LIKE', '%/SKL')
                ->orderByRaw('CAST(SUBSTRING_INDEX(id_surat, "/", 1) AS UNSIGNED) DESC')
                ->first();

            $highestNumber = 0;
            if ($latestSurat) {
                $parts = explode('/', $latestSurat->id_surat);
                if (isset($parts[0]) && is_numeric($parts[0])) {
                    $highestNumber = (int)$parts[0];
                }
            }

            // Step 6: Generate the next ID
            $nextNumber = $highestNumber + 1;
            $formattedIdSurat = sprintf("%03d/SKL", $nextNumber);

            // Step 7: Create and save the new DetailSurat record
            $detailSurat = new DetailSurat();
            $detailSurat->id_surat = $formattedIdSurat;
            $detailSurat->nrp = $nrp;
            $detailSurat->nama = $nama;
            $detailSurat->semester = null; // Useless column
            $detailSurat->alamat_mhs = null; // Useless column
            $detailSurat->tujuan_surat = null; // Useless column
            $date = Carbon::createFromFormat('d/m/Y', $validated['graduation_date']);
            if (!$date) {
                return redirect()->back()->with('error', 'Tanggal kelulusan tidak valid.');
            }
            $detailSurat->tanggal_surat = $date;
            $detailSurat->kategori_surat = 3;
            $detailSurat->alamat_surat = null; // Useless column
            $detailSurat->topik = null; // Useless column
            $detailSurat->nama_kode_matkul = null; // Useless column
            $detailSurat->save();

            // Step 8: Commit the transaction
            DB::commit();

            return redirect()->back()->with('success', 'Surat berhasil diajukan dengan nomor: ' . $formattedIdSurat);
        } catch (\Exception $e) {
            // Step 9: Rollback the transaction if an error occurs
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
}