<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller; // <- Tambahkan ini

class AdminController extends Controller
{
    public function createMahasiswa()
    {
        $programstudi = DB::table('programstudi')->get();
        return view('admin.create_mahasiswa', compact('programstudi'));
    }

    public function storeMahasiswa(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:mahasiswa,email',
            'nrp' => 'required|string|unique:mahasiswa,nrp',
            'password' => 'required|string|min:6',
            'id_prodi' => 'required|exists:programstudi,id_prodi',
        ]);

        $lastUser = DB::table('user')
            ->where('id_user', '>=', 1000)
            ->where('id_user', '<', 2000)
            ->orderByDesc('id_user')
            ->first();

        $newId = $lastUser ? $lastUser->id_user + 1 : 1001;

        DB::table('user')->insert([
            'id_user' => $newId,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        DB::table('mahasiswa')->insert([
            'id_user' => $newId,
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'email' => $request->email,
            'status_mhs' => 0,
            'tanggal_kelulusan' => null,
            'id_prodi' => $request->id_prodi,
        ]);

        return redirect()->route('admin.create.mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function createStaff()
    {
        $programstudi = DB::table('programstudi')->get();
        return view('admin.create_staff', compact('programstudi'));
    }

    public function storeStaff(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:staff',
            'password' => 'required|string|min:6',
            'id_prodi' => 'required|exists:programstudi,id_prodi',
        ]);

        // Cari id_user terakhir untuk staff (3xxx)
        $lastUser = DB::table('user')->where('role', 'staff')->orderByDesc('id_user')->first();
        $newUserId = $lastUser ? $lastUser->id_user + 1 : 3001;

        // Simpan ke tabel user
        DB::table('user')->insert([
            'id_user' => $newUserId,
            'password' => Hash::make($request->password),
            'role' => 'staff',
        ]);

        // Generate id_staff otomatis: S001, S002, dst
        $lastStaff = DB::table('staff')->orderByDesc('id_staff')->first();
        $lastNumber = $lastStaff ? intval(substr($lastStaff->id_staff, 1)) : 0;
        $newStaffId = 'S' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // Simpan ke tabel staff
        DB::table('staff')->insert([
            'id_staff' => $newStaffId,
            'nama' => $request->nama,
            'email' => $request->email,
            'id_user' => $newUserId,
            'id_prodi' => $request->id_prodi,
        ]);

        return redirect()->route('admin.create.staff')->with('success', 'Staff berhasil ditambahkan.');
    }

    public function createKaprodi()
    {
        $programstudi = DB::table('programstudi')->get();
        return view('admin.create_kaprodi', compact('programstudi'));
    }

    public function storeKaprodi(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:kaprodi',
            'password' => 'required|string|min:6',
            'id_prodi' => 'required|exists:programstudi,id_prodi',
        ]);

        // Cari ID terakhir user dengan role kaprodi
        $lastUser = DB::table('user')->where('role', 'kaprodi')->orderByDesc('id_user')->first();
        $newUserId = $lastUser ? $lastUser->id_user + 1 : 2001;

        // Simpan ke tabel user
        DB::table('user')->insert([
            'id_user' => $newUserId,
            'password' => Hash::make($request->password),
            'role' => 'kaprodi',
        ]);

        // Auto-increment untuk id_kaprodi
        $lastKaprodi = DB::table('kaprodi')->orderByDesc('id_kaprodi')->first();

        if ($lastKaprodi) {
            // Ambil angka dari id_kaprodi terakhir (contoh: 'K048' => 48)
            $lastNumber = intval(substr($lastKaprodi->id_kaprodi, 1));
            $newKaprodiId = 'K' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newKaprodiId = 'K001';
        }

        // Simpan ke tabel kaprodi
        DB::table('kaprodi')->insert([
            'id_kaprodi' => $newKaprodiId,
            'nama' => $request->nama,
            'email' => $request->email,
            'id_user' => $newUserId,
            'id_prodi' => $request->id_prodi,
        ]);

        return redirect()->route('admin.create.kaprodi')->with('success', 'Kaprodi berhasil ditambahkan.');
    }    
}
