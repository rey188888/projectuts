<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSurat extends Model
{
    // Specify the table name (optional if the table name matches the model name in lowercase with 's')
    protected $table = 'detail_surat';

    // Specify the primary key (optional if the primary key is 'id')
    protected $primaryKey = 'id_surat';

    // Disable timestamps if the table does not have created_at and updated_at columns
    public $timestamps = false;

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'nama',
        'kategori_surat',
        'tanggal_surat',
        'semester',
        'tujuan_surat',
        'alamat_mhs',
        'alamat_surat',
        'topik',
        'nama_kode_matkul',
        'hasil_surat',
    ];

    // Define the data types for specific columns (optional, for casting)
    protected $casts = [
        'tanggal_surat' => 'date',
        'kategori_surat' => 'integer',
        'semester' => 'integer',
    ];
}