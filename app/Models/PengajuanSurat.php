<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    // Specify the table name (optional if the table name matches the model name in lowercase with 's')
    protected $table = 'pengajuansurat';

    // Specify the primary key (optional if the primary key is 'id')
    protected $primaryKey = 'id_log';

    // Disable timestamps if the table does not have created_at and updated_at columns
    public $timestamps = false;

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'status_surat',
        'tanggal_perubahan',
        'keterangan_penolakan',
        'id_surat',
        'nrp',
        'id_staff',
        'id_kaprodi',
    ];

    // Define the data types for specific columns (optional, for casting)
    protected $casts = [
        'status_surat' => 'integer',
        'tanggal_perubahan' => 'datetime',
        'id_surat' => 'string',
        'id_staff' => 'string',
    ];

    // Define relationships
    public function surat()
    {
        return $this->belongsTo(DetailSurat::class, 'id_surat', 'id_surat');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nrp', 'nrp');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'id_staff', 'id_staff');
    }

    public function kaprodi()
    {
        return $this->belongsTo(Kaprodi::class, 'id_kaprodi', 'id_kaprodi');
    }
}