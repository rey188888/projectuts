<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    // Specify the table name
    protected $table = 'kaprodi';

    // Specify the primary key
    protected $primaryKey = 'id_kaprodi';

    // Disable timestamps
    public $timestamps = false;

    // Define the fillable fields for mass assignment (exclude primary key)
    protected $fillable = [
        'id_kaprodi',
        'nama',
        'email',
        'id_prodi',
        'id_user',
    ];

    // Define the data types for specific columns
    protected $casts = [
        'id_prodi' => 'integer',
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