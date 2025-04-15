<?php

namespace App\Http\Controllers\Surat;

use App\Models\DetailSurat;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanSurat;
use App\Http\Controllers\Controller;

class KeteranganLulusController extends Controller
{
    public function storeSurat3(Request $request)
    {
        // Validasi input tanggal
        $validated = $request->validate([
            'graduation_date' => 'required|date',
        ], [
            'graduation_date.required' => 'Tanggal kelulusan wajib diisi.',
            'graduation_date.date' => 'Tanggal kelulusan tidak valid.',
        ]);

        // Ambil user & data mahasiswa
        $user = Auth::user();
        $student = Mahasiswa::where('id_user', $user->id_user)
            ->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Pengguna tidak terdaftar sebagai mahasiswa.');
        }

        DB::beginTransaction();

        try {
            // Update tanggal kelulusan di tabel mahasiswa
            $student->tanggal_kelulusan = $validated['graduation_date'];
            $student->save();

            // Generate nomor surat SKL
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

            $nextNumber = $highestNumber + 1;
            $formattedIdSurat = sprintf("%03d/SKL", $nextNumber);

            // Simpan ke DetailSurat
            $detailSurat = new DetailSurat();
            $detailSurat->id_surat = $formattedIdSurat;
            $detailSurat->nama = $student->nama;
            $detailSurat->tanggal_surat = $validated['graduation_date'];
            $detailSurat->kategori_surat = 3;
            $detailSurat->semester = null;
            $detailSurat->alamat_mhs = null;
            $detailSurat->tujuan_surat = null;
            $detailSurat->alamat_surat = null;
            $detailSurat->topik = null;
            $detailSurat->nama_kode_matkul = null;
            $detailSurat->save();

            // Simpan ke PengajuanSurat
            PengajuanSurat::create([
                'status_surat' => 0,
                'tanggal_perubahan' => now(),
                'keterangan_penolakan' => null,
                'nrp' => $student->nrp,
                'id_surat' => $formattedIdSurat,
                'id_user' => $user->id_user,
                'id_staff' => null,
                'id_kaprodi' => null,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Surat berhasil diajukan dengan nomor: ' . $formattedIdSurat);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
}
