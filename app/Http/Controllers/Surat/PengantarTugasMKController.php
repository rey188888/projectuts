<?php

namespace App\Http\Controllers\Surat;

use App\Models\DetailSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;

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

        // Begin a transaction
        DB::beginTransaction();
        
        try {
            // Find the highest existing number for the SPTMK format
            $highestNumber = 0;
            $latestSurat = DB::table('detail_surat')
                ->where('id_surat', 'LIKE', '%/SPTMK')
                ->orderByRaw('CAST(SUBSTRING_INDEX(id_surat, \'/\', 1) AS UNSIGNED) DESC')
                ->first();
            
            if ($latestSurat) {
                $parts = explode('/', $latestSurat->id_surat);
                if (isset($parts[0]) && is_numeric($parts[0])) {
                    $highestNumber = (int)$parts[0];
                }
            }
            
            // Generate the next ID
            $nextNumber = $highestNumber + 1;
            $formattedIdSurat = sprintf("%03d/SPTMK", $nextNumber);
            
            // Create a new instance and set properties explicitly
            $detailSurat = new DetailSurat();
            $detailSurat->id_surat = $formattedIdSurat;
            $detailSurat->nama = $nama;
            $detailSurat->kategori_surat = 2;
            $detailSurat->tanggal_surat = now();
            $detailSurat->semester = $request->semester;
            $detailSurat->tujuan_surat = $request->purpose;
            $detailSurat->alamat_mhs = null;
            $detailSurat->alamat_surat = $request->recipient;
            $detailSurat->topik = $request->topic;
            $detailSurat->nama_kode_matkul = $request->course;
            $detailSurat->save();
            
            // Commit the transaction
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
            // Rollback the transaction if an error occurs
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
}