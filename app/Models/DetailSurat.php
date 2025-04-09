<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSurat extends Model
{
    // Specify the table name
    protected $table = 'detail_surat';

    // Specify the primary key
    protected $primaryKey = 'id_surat';

    // Disable timestamps if the table does not have created_at and updated_at columns
    public $timestamps = false;

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'id_surat',
        'nama',
        'kategori_surat',
        'tanggal_surat',
        'semester',
        'tujuan_surat',
        'alamat_mhs',
        'alamat_surat',
        'topik',
        'nama_kode_matkul',
        'hasil_surat', // Sudah ada, siap digunakan untuk menyimpan path file
    ];

    // Define the data types for specific columns (optional, for casting)
    protected $casts = [
        'tanggal_surat' => 'date',
        'kategori_surat' => 'integer',
        'semester' => 'integer',
        'id_surat' => 'string', // Tambahkan casting untuk id_surat karena bertipe string
        'hasil_surat' => 'string', // Tambahkan casting untuk hasil_surat
    ];

    // Define relationships
    public function pengajuanSurat()
    {
        return $this->hasOne(PengajuanSurat::class, 'id_surat', 'id_surat');
    }
}