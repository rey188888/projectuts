<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // Specify the table name
    protected $table = 'mahasiswa';

    // Specify the primary key
    protected $primaryKey = 'nrp';

    // Disable timestamps
    public $timestamps = false;

    // Define the fillable fields for mass assignment (exclude primary key)
    protected $fillable = [
        'nrp',
        'nama',
        'email',
        'status_mhs',
        'tanggal_kelulusan',
        'id_prodi',
        'id_user',
    ];

    // Define the data types for specific columns
    protected $casts = [
        'status_mhs' => 'integer',
        'tanggal_kelulusan' => 'date',
        'id_prodi' => 'string',
    ];

    // Define relationships
    public function prodi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi', 'id_prodi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}