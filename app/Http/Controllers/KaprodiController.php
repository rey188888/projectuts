<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function index(Request $request)
    {
        $statusFilter = $request->query('status_filter');

        $query = PengajuanSurat::query()
            ->leftJoin('detail_surat', 'pengajuansurat.id_surat', '=', 'detail_surat.id_surat')
            ->leftJoin('mahasiswa', 'pengajuansurat.nrp', '=', 'mahasiswa.nrp')
            ->select(
                'pengajuansurat.*',
                'detail_surat.hasil_surat',
                'detail_surat.tujuan_surat',
                'detail_surat.alamat_mhs',
                'detail_surat.alamat_surat',
                'detail_surat.topik',
                'detail_surat.nama_kode_matkul',
                'detail_surat.semester',
                'detail_surat.nama',
                'detail_surat.kategori_surat',
                'detail_surat.tanggal_surat',
                'mahasiswa.tanggal_kelulusan'
            );

        if ($statusFilter !== null && $statusFilter !== '') {
            $query->where('pengajuansurat.status_surat', $statusFilter);
        }

        $pengajuansurat = $query->get();

        return view('kaprodi.index', compact('pengajuansurat'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id_surat' => 'required|string',
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $surat = PengajuanSurat::where('id_surat', $request->id_surat)->firstOrFail();

        if ($request->status === 'disetujui') {
            $surat->status_surat = 1;
            $surat->keterangan_penolakan = null;
        } elseif ($request->status === 'ditolak') {
            $surat->status_surat = 2;
            $surat->keterangan_penolakan = $request->keterangan_penolakan;
        }

        $surat->tanggal_perubahan = now();
        $surat->save();

        return redirect()->back()->with('success', 'Status surat berhasil diperbarui.');
    }
}
