<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function index()
    {
        // Fetch data from the database
        $pengajuanSurat = PengajuanSurat::all(); // You can add conditions here if needed

        // Pass the data to the view
        return view('kaprodi.index', compact('pengajuanSurat'));
    }
}