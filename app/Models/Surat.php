<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'detail_surat';
    protected $primaryKey = 'id_surat';
    public $timestamps = false;

    protected $fillable = [
        'nrp',
        'nama',
        'kategori_surat',
        'tanggal_surat',
        'semester',
        'tujuan_surat',
        'alamat_mhs',
        'alamat_surat',
        'topik',
        'nama_kode_matkul',
    ];
}