<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'programstudi';

    protected $primaryKey = 'id_prodi';

    protected $fillable = [
        'id_prodi',
        'nama_prodi',
    ];

    public $timestamps = false;
}
