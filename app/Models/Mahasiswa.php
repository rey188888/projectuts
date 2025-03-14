<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $primaryKey = 'nrp';

    protected $fillable = [
        'nrp',
        'nama',
        'email',
        'id_prodi',
        'tanggal_kelulusan',
    ];

    public $timestamps = false;
}
